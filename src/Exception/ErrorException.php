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
    protected $actualError;

    /**
     * @var
     */
    protected $context;

    /**
     * ErrorException constructor.
     *
     * @param string $message
     * @param int $code
     * @param int $severity
     * @param string $filename
     * @param int $lineno
     * @param \Exception $previous
     * @param \Exception $previous
     * @param array $context
     */
    public function __construct(
        $message,
        $code,
        $severity,
        $filename,
        $lineno,
        $previous = null,
        $actualError = null,
        $context = []
    ) {
        $this->actualError = $actualError;
        $this->context = $context;
        parent::__construct($message, $code, $severity, $filename, $lineno, $previous);
    }

    /**
     * getActualError
     *
     * @return \Throwable|null
     */
    public function getActualException()
    {
        return $this->actualError;
    }

    /**
     * throwActual
     *
     * @return void
     * @throws \Throwable
     */
    public function throwActual()
    {
        if ($this->actualError instanceof \Throwable) {
            throw $this->actualError;
        }

        throw $this;
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
}
