<?php

namespace RcmErrorHandler2\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RcmErrorHandler2\Http\ErrorRequest;
use RcmErrorHandler2\Http\ErrorResponse;
use Zend\Stratigility\FinalHandler;
use Zend\Stratigility\Next;

/**
 * Class MiddlewarePipe
 * // @todo This doe not work perfectly.  Could use a custom MiddlewarePipe or Promise
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class MiddlewarePipe extends \Zend\Stratigility\MiddlewarePipe
{
    /**
     * Handle a request
     *
     * Takes the pipeline, creates a Next handler, and delegates to the
     * Next handler.
     *
     * If $out is a callable, it is used as the "final handler" when
     * $next has exhausted the pipeline; otherwise, a FinalHandler instance
     * is created and passed to $next during initialization.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable $out
     * @return ResponseInterface
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $out = null)
    {
        if (!$request instanceof ErrorRequest) {
            throw new \Exception('Error display requires instance of ErrorRequest');
        }
        if (!$response instanceof ErrorResponse) {
            throw new \Exception('Error display requires instance of ErrorResponse');
        }

        $done   = $out ?: new FinalHandler([], $response);
        $next   = new Next($this->pipeline, $done);
        $result = $next($request, $response);

        return ($result instanceof ResponseInterface ? $result : $response);
    }
}
