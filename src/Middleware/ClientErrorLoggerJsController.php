<?php

namespace RcmErrorHandler2\Middleware;

use Zend\Stratigility\Http\Request;
use Zend\Stratigility\Http\Response;

/**
 * Class ClientErrorLoggerJsController
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ClientErrorLoggerJsController
{
    /**
     * __invoke
     *
     * @param Request       $request
     * @param Response      $response
     * @param callable|null $next
     *
     * @return $response
     */
    public function __invoke(Request $request, Response $response, callable $next = null)
    {
        $js = file_get_contents(__DIR__ . '/../../public/js-error-logger.js');

        $body = $response->getBody();

        $body->write($js);

        $response = $response->withHeader('content-type', 'application/javascript');

        return $response->withBody($body);
    }
}
