<?php

namespace RcmErrorHandler2\Handler;

use RcmErrorHandler2\Exception\ErrorException;

/**
 * Interface Throwable
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
interface Throwable extends Handler
{
    /**
     * handle
     *
     * @param \Exception|\Throwable $exception
     *
     * @return void
     */
    public function handle($exception);

    /**
     * getErrorException
     *
     * @param \Exception|\Throwable $exception
     *
     * @return ErrorException
     */
    public function getErrorException($exception);
}
