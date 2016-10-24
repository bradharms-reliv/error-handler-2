<?php

namespace RcmErrorHandler2\Exception;

/**
 * Class ErrorException - Wrapper for Errors and Exceptions
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorException extends \ErrorException
{
    /**
     * @var \Throwable|null
     */
    protected $actualException;

    /**
     * @var
     */
    protected $context;

    /**
     * @var
     */
    protected $handler;

    /**
     * ErrorException constructor.
     *
     * @param string $message
     * @param int    $code
     * @param int    $severity
     * @param string $filename
     * @param int    $lineno
     * @param null   $previous
     * @param null   $actualException
     * @param array  $context
     * @param string $handler
     */
    public function __construct(
        $message,
        $code,
        $severity,
        $filename,
        $lineno,
        $previous = null,
        $actualException = null,
        $context = [],
        $handler = 'UNKNOWN'
    ) {
        $this->actualException = $actualException;
        $this->context = $context;
        $this->handler = $handler;
        parent::__construct($message, $code, $severity, $filename, $lineno, $previous);
    }

    /**
     * getActualError
     *
     * @return \Throwable|null
     */
    public function getActualException()
    {
        if ($this->actualException instanceof \Throwable) {
            return $this->actualException;
        }

        return $this;
    }

    /**
     * getActualExceptionClass
     *
     * @return string
     */
    public function getActualExceptionClass()
    {
        return get_class($this->getActualException());
    }

    /**
     * throwActual
     *
     * @return void
     * @throws \Throwable
     */
    public function throwActual()
    {
        throw $this->getActualException();
    }

    /**
     * getContext
     *
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * setHandler
     *
     * @param string $handler
     *
     * @return void
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
    }

    /**
     * getHandler
     *
     * @return string
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * toArray
     *
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}
