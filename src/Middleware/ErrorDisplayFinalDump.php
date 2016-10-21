<?php

namespace RcmErrorHandler2\Middleware;

use RcmErrorHandler2\Http\ErrorRequest;
use RcmErrorHandler2\Http\ErrorResponse;
use RcmErrorHandler2\Service\ErrorExceptionExtractor;

/**
 * Class ErrorDisplayFinalDump
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayFinalDump extends ErrorDisplayAbstract implements ErrorDisplayFinal
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
        $response = $response->withNormalErrorHandling(true);
        $body = $response->getBody();

        $errorException = $request->getError();

        $result = ErrorExceptionExtractor::extractArray($errorException);

        ob_start();
        var_dump($result);
        $content = ob_get_contents();
        ob_end_clean();

        $body->write($content);

        return $response->withBody($body);
    }
}
