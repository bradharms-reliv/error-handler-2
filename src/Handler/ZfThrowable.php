<?php

namespace RcmErrorHandler2\Handler;

use Zend\EventManager\Event;

/**
 * Interface ZfThrowable
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
interface ZfThrowable extends Handler
{
    /**
     * handleEvent
     *
     * @param Event $event
     *
     * @return mixed
     */
    public function handleEvent(Event $event);
}
