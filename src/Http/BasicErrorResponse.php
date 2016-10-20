<?php

namespace RcmErrorHandler2\Http;

use Zend\Diactoros\Response;

/**
 * Class BasicErrorResponse
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class BasicErrorResponse extends Response implements ErrorResponse
{
    public function __construct($body, $status, array $headers, $normalErrorHandlerContinues = true)
    {
        $this->normalErrorHandlerContinues = $normalErrorHandlerContinues;
        parent::__construct($body, $status, $headers);
    }

    /**
     * @var bool
     */
    protected $normalErrorHandlerContinues = true;

    /**
     * stopNormalErrorHandling
     *
     * @return bool
     */
    public function stopNormalErrorHandling()
    {
        return !$this->normalErrorHandlerContinues;
    }
}
