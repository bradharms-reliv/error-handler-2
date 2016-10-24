<?php

namespace RcmErrorHandler2\Handler;

use Zend\EventManager\Event;

/**
 * Class BasicZfThowable
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class BasicZfThrowable extends AbstractThrowable implements ZfThrowable, Handler
{
    /**
     * handle
     *
     * @param Event $event
     *
     * @return void
     */
    public function handleEvent(Event $event)
    {
        $exception = $event->getParam('exception');

        if (!$exception) {
            return;
        }

        parent::handle($exception);
    }

}
