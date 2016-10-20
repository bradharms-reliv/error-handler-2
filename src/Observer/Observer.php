<?php

namespace RcmErrorHandler2\Observer;

use RcmErrorHandler2\Exception\ErrorException;

/**
 * Interface Observer
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
interface Observer
{
    /**
     * getName
     *
     * @return string
     */
    public function getName();

    /**
     * notify
     *
     * @param ErrorException $error
     *
     * @return void
     */
    public function notify(ErrorException $error);
}
