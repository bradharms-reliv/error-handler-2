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
     * This works best by using http status code
     *
     * int
     */
    protected static $defaultCode = 500;

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
     * getDefaultCode
     *
     * @return int
     */
    public static function buildDefaultCode($code)
    {
        if (empty($code)) {
            $code = self::$defaultCode;
        }

        return $code;
    }

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
            self::$defaultCode,
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
                self::$defaultCode,
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

        $code = self::buildDefaultCode($exception->getCode());

        if (!$errorException instanceof ErrorException) {
            // Wrap it in an error exception
            $errorException = new ErrorException(
                $exception->getMessage(),
                $code,
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

    /**
     * buildFromUnknown
     *
     * @param        $err
     * @param string $handler
     *
     * @return ErrorException
     */
    public static function buildFromUnknown(
        $err,
        $handler = 'UNKNOWN'
    ) {
        if ($err instanceof ErrorException) {
            return $err;
        }

        if ($err instanceof \Exception || $err instanceof \Throwable) {
            return self::buildFromThrowable($err, $handler);
        }

        $message = 'GENERIC ERROR: ';
        $code = self::$defaultCode;

        if (empty($err)) {
            $message = 'EMPTY ERROR: (' . json_encode($err) . ')';
        }

        if (is_string($err)) {
            $message = $err;
        }

        if (is_int($err)) {
            $code = $err;
            $message = $message . '(' . $err . ')';
        }

        if (is_array($err)) {
            $message = $message . '(' . json_encode($err) . ')';
        }

        if (is_object($err)) {
            $export = var_export($err, true);
            $export = substr($export, 0, 255);
            $message = $message . "\n" . $export;
        }

        return new ErrorException(
            $message,
            $code,
            E_USER_ERROR,
            __FILE__,
            __LINE__,
            null,
            null,
            [],
            $handler
        );
    }
}
