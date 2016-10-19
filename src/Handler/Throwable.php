<?php

namespace RcmErrorHandler2\Handler;

use RcmErrorHandler2\Core\ObserverSubject;

/**
 * Interface Throwable
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
interface Throwable extends ObserverSubject
{
    /**
     * handle
     *
     * @param \Throwable $exception
     *
     * @return mixed
     */
    public function handle(\Throwable $exception);
}
