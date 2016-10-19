<?php

namespace RcmErrorHandler2\Exception;

/**
 * Class ErrorException
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorException extends \ErrorException
{
    /**
     * @var
     */
    protected $context;

    /**
     * ErrorException constructor.
     *
     * @param string     $message
     * @param int        $code
     * @param int        $severity
     * @param string     $filename
     * @param int        $lineno
     * @param \Exception $previous
     * @param array      $context
     */
    public function __construct($message, $code, $severity, $filename, $lineno, $previous = null, $context = [])
    {
        $this->context = $context;
        parent::__construct($message, $code, $severity, $filename, $lineno, $previous);
    }

    /**
     * getContext
     *
     * @return array
     */
    public function getContext() {
        return $this->context;
    }
}
