<?php

namespace RcmErrorHandler2\Middleware;

use RcmErrorHandler2\Formatter\Formatter;
use RcmErrorHandler2\Http\ErrorRequest;
use RcmErrorHandler2\Http\ErrorResponse;

/**
 * Class ErrorDisplayBasic
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayBasic
{
    /**
     * __invoke
     *
     * @param ErrorRequest  $request
     * @param ErrorResponse $response
     * @param callable|null $next
     *
     * @return callable|ErrorResponse
     */
    public function __invoke(ErrorRequest $request, ErrorResponse $response, callable $next = null)
    {
        $body = $response->getBody();
        $body->write('An unhandled error occurred');

        return $response->withBody($body);
    }
}
