<?php

namespace RcmErrorHandler2\Middleware;

use RcmErrorHandler2\Formatter\Formatter;
use RcmErrorHandler2\Http\ErrorRequest;
use RcmErrorHandler2\Http\ErrorResponse;

/**
 * Class ErrorDisplaySimple
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplaySimple
{
    /**
     * @var Formatter
     */
    protected $formatter;

    /**
     * ErrorDisplayBasic constructor.
     *
     * @param Formatter $formatter
     */
    public function __construct(
        Formatter $formatter
    ) {
        $this->formatter = $formatter;
    }

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

        $errorString = $this->formatter->format($request->getError());

        $body->write($errorString);

        $response = $response->withBody($body);

        return $response;
    }
}
