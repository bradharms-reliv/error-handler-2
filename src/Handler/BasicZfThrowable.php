<?php

namespace RcmErrorHandler2\Handler;

use RcmErrorHandler2\Exception\ErrorException;
use RcmErrorHandler2\Http\BasicErrorResponse;
use RcmErrorHandler2\Service\ErrorExceptionBuilder;
use RcmErrorHandler2\Service\ErrorServerRequestFactory;
use RcmErrorHandler2\Service\PhpErrorHandlerManager;
use RcmErrorHandler2\Service\PhpErrorSettings;
use Zend\EventManager\Event;
use Zend\Mvc\MvcEvent;

/**
 * Class BasicZfThowable
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class BasicZfThrowable extends AbstractHandler implements ZfThrowable, Handler
{
    /**
     * handle
     *
     * @param MvcEvent|Event $event
     *
     * @return void
     */
    public function handle(Event $event)
    {
        $exception = $event->getParam('exception');

        if (!$exception) {
            return;
        }

        $errorException = $this->getErrorException($exception);

        $request = ErrorServerRequestFactory::errorRequestFromGlobals(
            $errorException
        );

        $response = new BasicErrorResponse(
            $this->errorResponseConfig->get('body'),
            $this->errorResponseConfig->get('status'),
            $this->errorResponseConfig->get('headers')
        );

        $errorResponse = $this->notify($request, $response);

        $this->display($errorResponse);

        // @todo This logic might not be what we want
        if ($errorResponse->stopNormalErrorHandling()) {
            $event->stopPropagation(true);
            return;
        }

        // Steeling the error handling form ZF
        if (!PhpErrorSettings::canDisplayErrors()) {
            die;
        }
    }

    /**
     * getErrorException
     *
     * @param \Exception|\Throwable $exception
     *
     * @return ErrorException
     */
    public function getErrorException($exception)
    {
        return ErrorExceptionBuilder::buildFromThrowable(
            $exception,
            static::class
        );
    }
}
