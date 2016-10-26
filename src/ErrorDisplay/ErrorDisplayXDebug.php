<?php

namespace RcmErrorHandler2\ErrorDisplay;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RcmErrorHandler2\Http\ErrorRequest;
use RcmErrorHandler2\Http\ErrorResponse;

/**
 * Class ErrorDisplayXDebug
 * @todo This is not complete
 * @todo This only works with exception, might get this working with errors
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayXDebug extends ErrorDisplayAbstract implements ErrorDisplay
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
    public function __invoke(RequestInterface $request, ResponseInterface $response, $next = null)
    {
        if (!extension_loaded('xdebug')) {
            return $next($request, $response);
        }

        $actualException = $request->getError()->getActualException();

        //$trace = debug_backtrace();

        if (!property_exists($actualException, 'xdebug_message')) {
            return $next($request, $response);
        }

        $response = $response->withNormalErrorHandling(false);

        $errorString = $actualException->xdebug_message;

        $body = $response->getBody();

        $body->write($errorString);

        $response = $response->withBody($body);

        return $response;
    }
}
