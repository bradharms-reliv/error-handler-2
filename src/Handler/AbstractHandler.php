<?php

namespace RcmErrorHandler2\Handler;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\ErrorResponseConfig;
use RcmErrorHandler2\Middleware\ErrorDisplayFinal;
use RcmErrorHandler2\Middleware\MiddlewarePipe;
use RcmErrorHandler2\Observer\Observer;
use RcmErrorHandler2\Exception\ErrorException;
use RcmErrorHandler2\Http\ErrorRequest;
use RcmErrorHandler2\Http\ErrorResponse;
use RcmErrorHandler2\Middleware\ErrorDisplay;
use RcmErrorHandler2\Service\ErrorExceptionBuilder;
use RcmErrorHandler2\Service\PhpErrorSettings;
use RcmErrorHandler2\Service\PhpServer;
use Zend\Diactoros\Response\EmitterInterface;

/**
 * Abstract Class AbstractHandler
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
abstract class AbstractHandler implements Handler
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var array
     */
    protected $observerServiceNames = [];

    /**
     * @var array [{Observer}, ...]
     */
    protected $observers = [];

    /**
     * @var array
     */
    protected $errorDisplaysServiceNames = [];

    /**
     * @var array [{ErrorDisplay}, ...]
     */
    protected $errorDisplays = [];

    /**
     * @var ErrorDisplayFinal
     */
    protected $errorDisplayFinal;

    /**
     * @var ErrorResponseConfig
     */
    protected $errorResponseConfig;

    /**
     * @var EmitterInterface
     */
    protected $emitter;

    /**
     * AbstractHandler constructor.
     *
     * @param                     $container
     * @param array               $observerServiceNames
     * @param array               $errorDisplaysServiceNames
     * @param ErrorDisplayFinal   $errorDisplayFinal
     * @param ErrorResponseConfig $errorResponseConfig
     */
    public function __construct(
        $container,
        array $observerServiceNames,
        array $errorDisplaysServiceNames,
        ErrorDisplayFinal $errorDisplayFinal,
        ErrorResponseConfig $errorResponseConfig,
        EmitterInterface $emitter
    ) {
        $this->container = $container;
        $this->observerServiceNames = $observerServiceNames;
        $this->errorDisplaysServiceNames = $errorDisplaysServiceNames;
        // @todo register these at run-time for efficiency.
        $this->registerServices();
        $this->errorDisplayFinal = $errorDisplayFinal;
        $this->errorResponseConfig = $errorResponseConfig;
        $this->emitter = $emitter;
    }

    /**
     * registerErrorDisplay
     *
     * @param ErrorDisplay $errorDisplay
     *
     * @return void
     */
    public function registerErrorDisplay(ErrorDisplay $errorDisplay)
    {
        $this->errorDisplays[$errorDisplay->getName()] = $errorDisplay;
    }

    /**
     * registerObserver
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function registerObserver($observer)
    {
        $this->observers[$observer->getName()] = $observer;
    }

    /**
     * notify
     *
     * @param ErrorException $error
     *
     * @return void
     */
    public function notifyObservers(ErrorException $error)
    {
        /** @var Observer $observer */
        foreach ($this->observers as $observer) {
            $observer->notify($error);
        }
    }

    /**
     * notify
     *
     * @param ErrorRequest  $request
     * @param ErrorResponse $response
     *
     * @return ErrorResponse
     */
    public function notify(ErrorRequest $request, ErrorResponse $response)
    {
        $errorException = $request->getError();
        // Since this is an exception handler, un-caught exceptions will not bubble up
        // In order to report these errors, we must handle them via try-catch
        try {
            $this->notifyObservers($errorException);
        } catch (\Exception $e) {
            // @todo Any error from here will not be properly handled
            // In this case, nothing will be logged
            // Since the error reporter broke, we will sent this error instead
            $localError = ErrorExceptionBuilder::buildFromThrowable($e);
            $request = $request->withError($localError);

            return $this->getResponse($request, $response);
        }

        return $this->getResponse($request, $response);
    }

    /**
     * getResponse
     *
     * @param ErrorRequest  $request
     * @param ErrorResponse $response
     *
     * @return ErrorResponse
     */
    public function getResponse(ErrorRequest $request, ErrorResponse $response)
    {
        // We set the initial status to a default
        $response = $response->withHeader(
            'status',
            (string)$this->errorResponseConfig->get('status', 500)
        );

        $final = $this->errorDisplayFinal;

        if (!PhpErrorSettings::canDisplayErrors()) {
            // In this case, nothing special will be displayed
            return $final($request, $response);
        }

        // Since this is an error handler, un-caught exceptions will not bubble up
        // In order to report these errors, we must handle them via try-catch
        try {
            $pipe = new MiddlewarePipe();

            foreach ($this->errorDisplays as $errorDisplay) {
                $pipe->pipe('/', $errorDisplay);
            }

            /** @var ErrorResponse $finalResponse */
            $finalResponse = $pipe($request, $response, $final);

            return $finalResponse;
        } catch (\Exception $e) {
            // @todo Any error from here will not be properly handled
            // In this case, only the final will happen;
            // Since the error reporter broke, we will sent this error instead
            $localError = ErrorExceptionBuilder::buildFromThrowable($e);
            $request = $request->withError($localError);

            return $final($request, $response);
        }
    }

    /**
     * display
     *
     * @todo Probably missing some stuff here
     *
     * @param ErrorResponse $response
     *
     * @return void
     */
    public function display(ErrorResponse $response)
    {
        $this->emitter->emit($response);
    }
//
//    /**
//     * getDisplay
//     *
//     * @param ErrorResponse $response
//     *
//     * @return string
//     */
//    public function getDisplay(ErrorResponse $response)
//    {
//        $headers = $response->getHeaders();
//
//        // PhpServer::setResponseHeaders($headers);
//
//        $body = $response->getBody();
//
//        var_dump('getDisplay', $body->getContents());
//
//        return $body->getContents();
//    }

    /**
     * registerServices
     *
     * @return void
     */
    protected function registerServices()
    {
        foreach ($this->observerServiceNames as $observerName => $options) {
            $observerService = $this->container->get($observerName);
            $this->registerObserver($observerService);
        }

        foreach ($this->errorDisplaysServiceNames as $errorDisplayName) {
            $errorDisplaysService = $this->container->get($errorDisplayName);
            $this->registerErrorDisplay($errorDisplaysService);
        }
    }
}
