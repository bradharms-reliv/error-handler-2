<?php

namespace RcmErrorHandler2\Handler;

use RcmErrorHandler2\Core\AbstractObserverSubject;
use RcmErrorHandler2\Core\Observer;
use RcmErrorHandler2\Exception\ErrorException;

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
     * getName
     *
     * @return string
     */
    public function getName()
    {
        return self::class;
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
        if (!(error_reporting() & $errno)) {
            // This error code is not included in error_reporting
            return;
        }

        $prev = $this->getPrevious();

        $error = new ErrorException(
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
    protected function getPrevious()
    {
        $prev = error_get_last();

        if ($prev !== null) {
            $prev = new ErrorException(
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
