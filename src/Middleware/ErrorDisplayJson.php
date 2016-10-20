<?php

namespace RcmErrorHandler2\Middleware;

use RcmErrorHandler2\Http\ErrorRequest;
use RcmErrorHandler2\Http\ErrorResponse;
use RcmErrorHandler2\Service\ErrorExceptionExtractor;

/**
 * Class ErrorDisplayJson
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayJson
{
    /**
     * __invoke
     *
     * @param ErrorRequest  $request
     * @param ErrorResponse $response
     * @param callable|null $next
     *
     * @return callable
     */
    public function __invoke(ErrorRequest $request, ErrorResponse $response, callable $next = null)
    {
        $errorException = $request->getError();

        if($request->hasHeader('accept') && $request->hasHeader('accept') == 'application/json') {
            return $next($request, $response);
        }

        // @todo Could move this to a formatter
        $localMessage =  'An unhandled exception has occurred in: ' . self::class . ' from: ';
        $result = ErrorExceptionExtractor::extractArray($errorException);
        $result['message'] = $localMessage . $result['message'];
        $content = json_encode($result, JSON_PRETTY_PRINT, 3);

        $response = $response->withHeader('status', '500');
        $response = $response->withHeader('content-type', 'application/json');

        $body = $response->getBody();

        $body->write($content);

        $response = $response->withBody($body);

        return $response;
    }
}
