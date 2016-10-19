<?php

namespace RcmErrorHandler2\Handler;

use RcmErrorHandler2\Core\AbstractObserverSubject;
use RcmErrorHandler2\Core\Observer;
use RcmErrorHandler2\Exception\ErrorException;
use RcmErrorHandler2\Service\PhpErrorSettings;

/**
 * Class AbstractError
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class AbstractError extends AbstractObserverSubject implements Error
{
    /**
     * @var array $errorMap
     */
    protected $errorMap
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
     * getExceptionClassName
     *
     * @param $errno
     *
     * @return string
     */
    public function getExceptionClassName($errno)
    {
        $prefix = 'Unknown';
        if (array_key_exists($errno, $this->errorMap)) {
            $prefix = $this->errorMap[$errno];
        }

        $class = "RcmErrorHandler2\\Exception\\{$prefix}Exception";

        if (!class_exists($class)) {
            $class = "RcmErrorHandler2\\Exception\\UnknownException";
        }

        return $class;
    }

    /**
     * handle
     *
     * @param int    $errno
     * @param int    $errstr
     * @param string $errfile
     * @param int    $errline
     * @param array  $errcontext
     *
     * @return bool
     */
    public function handle(
        $errno = 0,
        $errstr = 1,
        $errfile = __FILE__,
        $errline = __LINE__,
        $errcontext = []
    ) {
        // @todo This might not be what we want,
        if (!PhpErrorSettings::canReportErrors($errno)) {
            // This error code is not included in error_reporting
            return false;
        }

        $prev = $this->getPrevious();

        $exceptionClass = $this->getExceptionClassName($errno);

        /** @var ErrorException $error */
        $error = new $exceptionClass(
            $errstr,
            0,
            $errno,
            $errfile,
            $errline,
            $prev,
            $errcontext
        );

        return $this->notifyObservers($error);
    }

    /**
     * getPrevious
     *
     * @return array|ErrorException
     */
    public function getPrevious()
    {
        $prev = error_get_last();

        if ($prev !== null) {
            $exceptionClass = $this->getExceptionClassName($prev['type']);
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
}
