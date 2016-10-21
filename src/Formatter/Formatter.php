<?php

namespace RcmErrorHandler2\Formatter;

use RcmErrorHandler2\Core\Config;
use RcmErrorHandler2\Exception\ErrorException;

/**
 * Interface Formatter
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
interface Formatter
{
    /**
     * format
     *
     * @param ErrorException $errorException
     * @param Config         $options
     *
     * @return string
     */
    public function format(ErrorException $errorException, Config $options);
}
