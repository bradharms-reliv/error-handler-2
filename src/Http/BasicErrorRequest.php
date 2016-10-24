<?php

namespace RcmErrorHandler2\Http;

use RcmErrorHandler2\Exception\ErrorException;
use Zend\Diactoros\ServerRequest;

/**
 * Class BasicErrorRequest
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class BasicErrorRequest extends ServerRequest implements ErrorRequest
{
    /**
     * @var ErrorException
     */
    protected $error;

    /**
     * BasicErrorRequest constructor.
     *
     * @param array                                             $serverParams
     * @param array                                             $uploadedFiles
     * @param null|string                                       $uri
     * @param null|string                                       $method
     * @param \Psr\Http\Message\StreamInterface|resource|string $body
     * @param array                                             $headers
     * @param array                                             $cookies
     * @param array                                             $queryParams
     * @param array|null|object                                 $parsedBody
     * @param string                                            $protocol
     * @param ErrorException                                    $error
     */
    public function __construct(
        array $serverParams,
        array $uploadedFiles,
        $uri,
        $method,
        $body,
        array $headers,
        array $cookies,
        array $queryParams,
        $parsedBody,
        $protocol,
        ErrorException $error
    ) {
        $this->error = $error;
        parent::__construct(
            $serverParams,
            $uploadedFiles,
            $uri,
            $method,
            $body,
            $headers,
            $cookies,
            $queryParams,
            $parsedBody,
            $protocol
        );
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
