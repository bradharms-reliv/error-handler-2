<?php

namespace RcmErrorHandler2\Http;

use RcmErrorHandler2\Exception\ErrorException;
use Zend\Diactoros\Request;

/**
 * Class BasicErrorRequest
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class BasicErrorRequest extends Request implements ErrorRequest
{
    /**
     * @var ErrorException
     */
    protected $error;

    /**
     * BasicErrorRequest constructor.
     *
     * @param null|string                                       $uri
     * @param null|string                                       $method
     * @param \Psr\Http\Message\StreamInterface|resource|string $body
     * @param array                                             $headers
     * @param ErrorException                                    $error
     */
    public function __construct($uri, $method, $body, array $headers, ErrorException $error)
    {
        $this->error = $error;
        parent::__construct($uri, $method, $body, $headers);
    }

    /**
     * withError
     *
     * @param ErrorException $errorException
     *
     * @return BasicErrorRequest
     */
    public function withError(ErrorException $errorException)
    {
        $new = clone $this;
        $new->error = $errorException;
        return $new;
    }

    /**
     * getError
     *
     * @return ErrorException
     */
    public function getError()
    {
        return $this->error;
    }
}
