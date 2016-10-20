<?php

namespace RcmErrorHandler2\Observer;

use RcmErrorHandler2\Exception\ErrorException;

/**
 * Interface ObserverSubject
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
interface ObserverSubject
{
    /**
     * registerObserver
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function registerObserver($observer);

    /**
     * notifyObservers
     *
     * @param ErrorException $error
     *
     * @return void
     */
    public function notifyObservers(ErrorException $error);
}
