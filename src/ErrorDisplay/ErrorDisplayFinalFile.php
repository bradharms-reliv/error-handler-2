<?php

namespace RcmErrorHandler2\ErrorDisplay;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ErrorDisplayFile
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayFinalFile extends ErrorDisplayFile implements ErrorDisplayFinal
{

    /**
     * __invoke
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param null              $next
     *
     * @return \RcmErrorHandler2\Http\ErrorResponse
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, $next = null)
    {
        $response = parent::__invoke($request, $response, $next);

        return $response->withNormalErrorHandling(true);
    }
}
