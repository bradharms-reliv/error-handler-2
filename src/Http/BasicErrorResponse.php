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
    /**
     * @var bool
     */
    protected $complete = false;

    /**
     * BasicErrorResponse constructor.
     *
     * @param \Psr\Http\Message\StreamInterface|resource|string $body
     * @param int                                               $status
     * @param array                                             $headers
     * @param bool                                              $normalErrorHandlerContinues
     */
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

    /**
     * getNormalErrorHandlerContinues
     *
     * @return bool
     */
    public function getNormalErrorHandlerContinues()
    {
        return $this->normalErrorHandlerContinues;
    }

    /**
     * withNormalErrorHandling
     *
     * @param $normalErrorHandlerContinues
     *
     * @return ErrorResponse
     */
    public function withNormalErrorHandling($normalErrorHandlerContinues)
    {
        $new = clone $this;
        $new->normalErrorHandlerContinues = (bool)$normalErrorHandlerContinues;

        return $new;
    }

    /**
     * Write data to the response body
     *
     * Proxies to the underlying stream and writes the provided data to it.
     *
     * @param string $data
     *
     * @return self
     * @throws \RuntimeException if response is already completed
     */
    public function write($data)
    {
        if ($this->complete) {
            throw new \RuntimeException(__METHOD__ . ' is already complete');
        }

        $this->getBody()->write($data);

        return $this;
    }

    /**
     * Mark the response as complete
     *
     * A completed response should no longer allow manipulation of either
     * headers or the content body.
     *
     * If $data is passed, that data should be written to the response body
     * prior to marking the response as complete.
     *
     * @param string $data
     *
     * @return self
     */
    public function end($data = null)
    {
        if ($this->complete) {
            return $this;
        }

        if ($data) {
            $this->write($data);
        }

        $new = clone $this;
        $new->complete = true;

        return $new;
    }

    /**
     * Indicate whether or not the response is complete.
     *
     * I.e., if end() has previously been called.
     *
     * @return bool
     */
    public function isComplete()
    {
        return $this->complete;
    }
}
