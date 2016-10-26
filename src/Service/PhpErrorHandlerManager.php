<?php

namespace RcmErrorHandler2\Service;

use RcmErrorHandler2\Handler\Handler;

/**
 * Class PhpErrorHandlerManager
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class PhpErrorHandlerManager
{
    /**
     * @var
     */
    protected static $lastErrorHandler;

    /**
     * @var
     */
    protected static $lastExceptionHandler;

    /**
     * setHandlers
     *
     * @param Handler $handler
     *
     * @return void
     */
    public static function setHandlers(Handler $handler)
    {
        self::setExceptionHandler($handler);
        self::setErrorHandler($handler);
    }

    /**
     * setErrorHandler
     *
     * @param Handler $handler
     *
     * @return void
     */
    public static function setErrorHandler(Handler $handler)
    {
        $originalHandler = set_error_handler(
            [
                $handler,
                'handle'
            ]
        );

        self::$lastErrorHandler = $originalHandler;

        /* @todo Should this be done? *
         * register_shutdown_function(
         * function ($errorHandler) {
         *
         * $err = error_get_last();
         *
         * $errorHandler->handle(
         * $err['type'],
         * $err['message'],
         * $err['file'],
         * $err['line'],
         * array('SHUT')
         * );
         * return true;
         * },
         * $errorHandler
         * );
         * /* */
    }

    /**
     * throwWithOriginalErrorHandler
     *
     * @param \Throwable $exception
     *
     * @return bool
     */
    public static function throwWithOriginalErrorHandler() {
        restore_error_handler();
        return false;
    }

    /**
     * getCurrentErrorHandler
     *
     * @return mixed
     */
    public static function getCurrentErrorHandler()
    {
        set_error_handler($handler = set_error_handler('var_dump'));
        // Set the handler back to itself immediately after capturing it.

        return $handler; // NULL | string | array(2) | Closure
    }

    /**
     * setExceptionHandler
     *
     * @param Handler $handler
     *
     * @return void
     */
    public static function setExceptionHandler(Handler $handler)
    {
        $originalHandler = set_exception_handler(
            [
                $handler,
                'handle'
            ]
        );

        self::$lastExceptionHandler = $originalHandler;
    }

    /**
     * throwWithOriginalExceptionHandler
     *
     * @param \Throwable $exception
     *
     * @return void
     * @throws \Throwable
     */
    public static function throwWithOriginalExceptionHandler(\Throwable $exception)
    {
        restore_error_handler();
        throw $exception;
    }

    /**
     * throwWithDefaultExceptionHandler
     *
     * @param \Throwable $exception
     *
     * @return void
     * @throws \Throwable
     */
    public static function throwWithDefaultExceptionHandler(\Throwable $exception)
    {
        // only works in php 7
        set_exception_handler(null);
        throw $exception;
    }

    /**
     * getCurrentErrorHandler
     *
     * @return mixed
     */
    public static function getCurrentExceptionHandler()
    {
        set_exception_handler($handler = set_exception_handler('var_dump'));
        // Set the handler back to itself immediately after capturing it.

        return $handler; // NULL | string | array(2) | Closure
    }
}
