<?php

namespace RcmErrorHandler2\ErrorDisplay;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
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
class ErrorDisplayJsonBasic extends ErrorDisplayJsonAbstract implements ErrorDisplay
{
    /**
     * __invoke
     *
     * @param ErrorRequest  $request
     * @param ErrorResponse $response
     * @param callable|null $next
     *
     * @return ErrorResponse
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, $next = null)
    {
        if (!$this->hasJsonHeader($request)) {
            return $next($request, $response);
        }

        $result = [];
        $result['message'] = 'An error occurred';
        $content = json_encode($result, JSON_PRETTY_PRINT);
        $body = $response->getBody();
        $body->write($content);

        // only our error please
        $response = $this->getNewResponse($body, false);

        return $response;
    }
}
