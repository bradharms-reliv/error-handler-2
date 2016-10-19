<?php

namespace RcmErrorHandler2\Core;

use RcmErrorHandler2\Exception\ErrorException;

/**
 * Abstract Class AbstractObserverSubject
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
abstract class AbstractObserverSubject implements ObserverSubject
{
    /**
     * @var array [{Observer}]
     */
    protected $observers = [];

    /**
     * AbstractError constructor.
     *
     * @param array $observers [{Observer}]
     */
    public function __construct(array $observers)
    {
        foreach ($observers as $observer) {
            $this->registerObserver($observer);
        }
    }

    /**
     * registerObserver
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function registerObserver($observer)
    {
        $this->observers[$observer->getName()] = $observer;
    }

    /**
     * notify
     *
     * @param ErrorException $error
     *
     * @return void
     */
    public function notifyObservers(ErrorException $error)
    {
        /** @var Observer $observer */
        foreach ($this->observers as $observer) {
            $observer->notify($error);
        }
    }
}
