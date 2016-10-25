<?php

namespace RcmErrorHandler2\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RcmErrorHandler2\Config\ErrorResponseConfig;
use RcmErrorHandler2\Config\RcmErrorHandler2Config;
use RcmErrorHandler2\Handler\BasicThrowable;
use RcmErrorHandler2\Handler\Throwable;
use RcmErrorHandler2\Http\BasicErrorResponse;
use RcmErrorHandler2\Service\ErrorExceptionBuilder;
use RcmErrorHandler2\Service\ErrorServerRequestFactory;
use RcmErrorHandler2\Service\PhpErrorHandlerManager;

/**
 * Class FinalHandler
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class FinalHandler
{
    /**
     * @var RcmErrorHandler2Config
     */
    protected $rcmErrorHandler2Config;

    /**
     * @var ErrorResponseConfig
     */
    protected $errorResponseConfig;

    /**
     * @var BasicThrowable|Throwable
     */
    protected $handler;

    /**
     * FinalHandler constructor.
     *
     * @param RcmErrorHandler2Config $rcmErrorHandler2Config
     * @param ErrorResponseConfig    $errorResponseConfig
     * @param Throwable              $handler
     */
    public function __construct(
        RcmErrorHandler2Config $rcmErrorHandler2Config,
        ErrorResponseConfig $errorResponseConfig,
        Throwable $handler
    ) {
        $this->rcmErrorHandler2Config = $rcmErrorHandler2Config;
        $this->errorResponseConfig = $errorResponseConfig;
        $this->handler = $handler;
    }

    /**
     * __invoke
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param null              $err
     *
     * @return ResponseInterface
     * @throws \Throwable
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, $err = null)
    {
        $errorException = ErrorExceptionBuilder::buildFromUnknown($err, static::class);

        // Check if we handle these
        $overrideExceptions = $this->rcmErrorHandler2Config->get('overrideExceptions', false);

        if (!$overrideExceptions) {
            PhpErrorHandlerManager::throwWithOriginalExceptionHandler($errorException->getActualException());
            die();
        }

        $errorRequest = ErrorServerRequestFactory::errorRequestFromGlobals(
            $errorException
        );

        $errorResponse = new BasicErrorResponse(
            $this->errorResponseConfig->get('body'),
            $this->errorResponseConfig->get('status'),
            $this->errorResponseConfig->get('headers')
        );

        $response = $this->handler->notify($errorRequest, $errorResponse);

        return $response;
    }
}
