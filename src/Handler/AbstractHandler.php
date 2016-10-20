<?php

namespace RcmErrorHandler2\Handler;

use RcmErrorHandler2\Observer\Observer;
use RcmErrorHandler2\Exception\ErrorException;
use RcmErrorHandler2\Http\ErrorRequest;
use RcmErrorHandler2\Http\ErrorResponse;
use RcmErrorHandler2\Middleware\ErrorDisplay;
use RcmErrorHandler2\Service\ErrorExceptionBuilder;
use RcmErrorHandler2\Service\PhpErrorSettings;
use RcmErrorHandler2\Service\PhpServer;
use Zend\Stratigility\MiddlewarePipe;

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
     * @var array [{Observer}, ...]
     */
    protected $observers = [];

    /**
     * @var array [{ErrorDisplay}, ...]
     */
    protected $errorDisplays = [];

    /**
     * AbstractHandler constructor.
     *
     * @param array $observers     [{Observer}]
     * @param array $errorDisplays [{ErrorDisplay}]
     */
    public function __construct(
        array $observers,
        array $errorDisplays
    ) {
        foreach ($observers as $observer) {
            $this->registerObserver($observer);
        }

        foreach ($errorDisplays as $errorDisplay) {
            $this->registerErrorDisplay($errorDisplay);
        }
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
        $response = $response->withHeader('status', '500');

        // @todo Might inject this
        $final = function (ErrorRequest $request, ErrorResponse $response, callable $next = null) {
            $body = $response->getBody();
            $body->write('An unhandled error occurred');

            return $response->withBody($body);
        };

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
     * @return mixed
     */
    public function display(ErrorResponse $response)
    {
        $headers = $response->getHeaders();

        PhpServer::setResponseHeaders($headers);

        $body = $response->getBody();

        echo $body->getContents();
    }
}
