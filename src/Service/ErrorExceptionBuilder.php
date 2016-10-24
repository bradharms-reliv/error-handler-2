<?php

namespace RcmErrorHandler2\Service;

use RcmErrorHandler2\Exception\ErrorException;

/**
 * Class ErrorExceptionBuilder
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorExceptionBuilder
{
    /**
     * @var array $errorMap
     */
    protected static $errorMap
        = [
            E_ERROR => 'Error',
            E_PARSE => 'Parse',
            E_CORE_ERROR => 'CoreError',
            E_COMPILE_ERROR => 'CompileError',
            E_USER_ERROR => 'UserError',
            E_RECOVERABLE_ERROR => 'RecoverableError',
            E_STRICT => 'Strict',
            E_WARNING => 'Warning',
            E_CORE_WARNING => 'CoreWarning',
            E_COMPILE_WARNING => 'CompileWarning',
            E_USER_WARNING => 'UserWarning',
            E_DEPRECATED => 'Deprecated',
            E_USER_DEPRECATED => 'UserDeprecated',
            E_NOTICE => 'Notice',
            E_USER_NOTICE => 'UserNotice',
            E_ALL => 'Unknown'
        ];

    /**
     * buildFromError
     *
     * @param int    $errno
     * @param int    $errstr
     * @param string $errfile
     * @param int    $errline
     * @param array  $errcontext
     * @param string $handler
     *
     * @return mixed
     */
    public static function buildFromError(
        $errno = 0,
        $errstr = 1,
        $errfile = __FILE__,
        $errline = __LINE__,
        $errcontext = [],
        $handler = 'UNKNOWN'
    ) {
        $prev = self::getPrevious();

        $exceptionClass = self::getExceptionClassName($errno);

        return new $exceptionClass(
            $errstr,
            0,
            $errno,
            $errfile,
            $errline,
            $prev,
            null,
            $errcontext,
            $handler
        );
    }

    /**
     * getExceptionClassName
     *
     * @param $errno
     *
     * @return string
     */
    public static function getExceptionClassName($errno)
    {
        $prefix = 'Unknown';
        if (array_key_exists($errno, self::$errorMap)) {
            $prefix = self::$errorMap[$errno];
        }

        $class = "RcmErrorHandler2\\Exception\\{$prefix}Exception";

        if (!class_exists($class)) {
            $class = "RcmErrorHandler2\\Exception\\UnknownException";
        }

        return $class;
    }

    /**
     * getPrevious
     *
     * @return array|ErrorException
     */
    public static function getPrevious()
    {
        $prev = error_get_last();

        if ($prev !== null) {
            $exceptionClass = self::getExceptionClassName($prev['type']);
            $prev = new $exceptionClass(
                $prev['message'],
                0,
                $prev['type'],
                $prev['file'],
                $prev['line'],
                null,
                []
            );
        }

        return $prev;
    }

    /**
     * buildFromThrowable
     *
     * @param \Throwable|\Exception $exception
     * @param string                $handler
     *
     * @return ErrorException
     */
    public static function buildFromThrowable(
        $exception,
        $handler = 'UNKNOWN'
    ) {
        $errorException = $exception;

        if (!$errorException instanceof ErrorException) {
            // Wrap it in an error exception
            $errorException = new ErrorException(
                $exception->getMessage(),
                $exception->getCode(),
                E_USER_ERROR,
                $exception->getFile(),
                $exception->getLine(),
                $exception->getPrevious(),
                $exception,
                [],
                $handler
            );
        }

        return $errorException;
    }
}
