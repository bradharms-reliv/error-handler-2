<?php

namespace RcmErrorHandler2\Handler;

use RcmErrorHandler2\Core\AbstractObserverSubject;
use RcmErrorHandler2\Exception\ErrorException;

/**
 * Abstract Class AbstractThrowable
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
abstract class AbstractThrowable extends AbstractObserverSubject implements Throwable
{
    /**
     * handle
     *
     * @param \Throwable $exception
     *
     * @return mixed
     */
    public function handle(\Throwable $exception)
    {
        $errorException = new ErrorException(
            $exception->getMessage(),
            $exception->getCode(),
            E_USER_ERROR,
            $exception->getFile(),
            $exception->getLine(),
            $exception,
            []
        );

        return $this->notifyObservers($errorException);
    }
}
