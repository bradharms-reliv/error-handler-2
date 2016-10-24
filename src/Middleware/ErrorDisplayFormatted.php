<?php

namespace RcmErrorHandler2\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RcmErrorHandler2\Config\Config;
use RcmErrorHandler2\Formatter\Formatter;
use RcmErrorHandler2\Http\ErrorRequest;
use RcmErrorHandler2\Http\ErrorResponse;

/**
 * Class ErrorDisplayFormatted
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayFormatted extends ErrorDisplayAbstract implements ErrorDisplay
{
    /**
     * @var Formatter
     */
    protected $formatter;

    /**
     * @var Config
     */
    protected $formatterConfig;

    /**
     * ErrorDisplayBasic constructor.
     *
     * @param Formatter $formatter
     */
    public function __construct(
        Formatter $formatter,
        Config $formatterConfig
    ) {
        $this->formatter = $formatter;
        $this->formatterConfig = $formatterConfig;
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
    public function __invoke(RequestInterface $request, ResponseInterface $response, $next = null)
    {
        $response = $response->withNormalErrorHandling(false);

        $body = $response->getBody();

        $errorString = $this->formatter->format($request->getError(), $this->formatterConfig);

        $body->write($errorString);

        $response = $response->withBody($body);

        return $response;
    }
}
