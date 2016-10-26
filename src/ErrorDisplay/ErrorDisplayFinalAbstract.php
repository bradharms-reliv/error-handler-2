<?php

namespace RcmErrorHandler2\ErrorDisplay;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RcmErrorHandler2\Config\ErrorDisplayConfig;
use RcmErrorHandler2\Http\ErrorRequest;
use RcmErrorHandler2\Http\ErrorResponse;

/**
 * Class ErrorDisplayFinalAbstract
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
abstract class ErrorDisplayFinalAbstract extends ErrorDisplayAbstract implements ErrorDisplay
{
    /**
     * @var ErrorDisplayConfig
     */
    protected $errorDisplayConfig;

    /**
     * ErrorDisplayFinalAbstract constructor.
     *
     * @param ErrorDisplayConfig $errorDisplayConfig
     */
    public function __construct(ErrorDisplayConfig $errorDisplayConfig)
    {
        $this->errorDisplayConfig = $errorDisplayConfig;
    }

    /**
     * getName
     *
     * @return string
     */
    public function getName()
    {
        return static::class;
    }

    /**
     * __invoke
     * For final handlers, we want normal error handling
     *
     * @param ErrorRequest  $request
     * @param ErrorResponse $response
     * @param callable|null $next
     *
     * @return callable|ErrorResponse
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, $next = null)
    {
        // For final handlers, we want normal error handling
        return $response->withNormalErrorHandling(true);
    }
}
