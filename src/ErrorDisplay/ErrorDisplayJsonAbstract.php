<?php

namespace RcmErrorHandler2\ErrorDisplay;

use Psr\Http\Message\RequestInterface;
use RcmErrorHandler2\Config\ErrorResponseConfig;
use RcmErrorHandler2\Http\BasicErrorResponse;

/**
 * Class ErrorDisplayJsonAbstract
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
abstract class ErrorDisplayJsonAbstract extends ErrorDisplayAbstract
{
    /**
     * @var ErrorResponseConfig
     */
    protected $errorResponseConfig;

    /**
     * ErrorDisplayJson constructor.
     *
     * @param ErrorResponseConfig $errorResponseConfig
     */
    public function __construct(
        ErrorResponseConfig $errorResponseConfig
    ) {
        $this->errorResponseConfig = $errorResponseConfig;
    }

    /**
     * hasJsonHeader
     *
     * @param RequestInterface $request
     *
     * @return bool
     */
    protected function hasJsonHeader(RequestInterface $request)
    {
        if (!$request->hasHeader('accept')) {
            return false;
        }

        $headerValues = $request->getHeader('accept');

        foreach ($headerValues as $headerValue) {
            if (strpos($headerValue, 'application/json') !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * getNewResponse
     *
     * @param      $body
     * @param bool $normalErrorHandlerContinues
     *
     * @return BasicErrorResponse
     */
    protected function getNewResponse(
        $body,
        $normalErrorHandlerContinues = true
    ) {
        return new BasicErrorResponse(
            $body,
            $this->errorResponseConfig->get('status'),
            ['content-type' => ['application/json']],
            $normalErrorHandlerContinues
        );
    }
}
