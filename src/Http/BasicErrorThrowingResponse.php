<?php

namespace RcmErrorHandler2\Http;

use RcmErrorHandler2\Exception\ErrorException;
use RcmErrorHandler2\Service\PhpErrorHandlerManager;

/**
 * Class BasicErrorThrowingResponse
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class BasicErrorThrowingResponse extends BasicErrorResponse implements ErrorResponse
{
    /**
     * @var
     */
    protected $originalErrorResponse;

    /**
     * @var ErrorException
     */
    protected $errorException;

    /**
     * BasicErrorThrowingResponse constructor.
     *
     * @param ErrorResponse  $errorResponse
     * @param ErrorException $errorException
     */
    public function __construct(ErrorResponse $errorResponse, ErrorException $errorException)
    {
        $this->originalErrorResponse = $errorResponse;
        $this->errorException = $errorException;
        parent::__construct(
            $errorResponse->getBody(),
            $errorResponse->getStatusCode(),
            $errorResponse->getHeaders(),
            $errorResponse->getNormalErrorHandlerContinues()
        );
    }

    /**
     * getBody
     *
     * @return void
     */
    public function getBody()
    {
        $body = $this->originalErrorResponse->getBody();
        $body->rewind();
        echo $body->getContents();
        PhpErrorHandlerManager::throwWithOriginalExceptionHandler($this->errorException->getActualException());
    }
}
