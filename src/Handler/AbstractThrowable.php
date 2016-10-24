<?php

namespace RcmErrorHandler2\Handler;

use RcmErrorHandler2\Exception\ErrorException;
use RcmErrorHandler2\Http\BasicErrorResponse;
use RcmErrorHandler2\Service\ErrorExceptionBuilder;
use RcmErrorHandler2\Service\ErrorServerRequestFactory;
use RcmErrorHandler2\Service\PhpErrorHandlerManager;

/**
 * Abstract Class AbstractThrowable
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
abstract class AbstractThrowable extends AbstractHandler implements Throwable
{
    /**
     * handle
     *
     * @param \Exception|\Throwable $exception
     *
     * @return void
     */
    public function handle($exception)
    {
        $errorException = $this->getErrorException($exception);

        $request = ErrorServerRequestFactory::errorRequestFromGlobals(
            $errorException
        );

        $response = new BasicErrorResponse(
            'php://memory',
            500,
            []
        );

        $errorResponse = $this->notify($request, $response);

        $this->display($errorResponse);
        // @todo This logic might not be what we want
        if ($errorResponse->stopNormalErrorHandling()) {
            exit(1);
        }

        PhpErrorHandlerManager::throwWithOriginalExceptionHandler($errorException->getActualException());
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
