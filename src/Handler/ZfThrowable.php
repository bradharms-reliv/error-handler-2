<?php

namespace RcmErrorHandler2\Handler;

use RcmErrorHandler2\Exception\ErrorException;
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
     * handle
     *
     * @param Event $event
     *
     * @return mixed
     */
    public function handle(Event $event);

    /**
     * getErrorException
     *
     * @param \Exception|\Throwable $exception
     *
     * @return ErrorException
     */
    public function getErrorException($exception);
}
