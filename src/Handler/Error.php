<?php

namespace RcmErrorHandler2\Handler;

use RcmErrorHandler2\Core\ObserverSubject;

/**
 * Interface Error
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
interface Error extends ObserverSubject
{
    /**
     * handle
     * http://php.net/manual/en/function.set-error-handler.php
     * The error handler must return FALSE to populate $php_errormsg
     *
     * @param int    $errno severity
     * @param int    $errstr message
     * @param string $errfile file
     * @param int    $errline line
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
    );
}
