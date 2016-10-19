<?php

namespace RcmErrorHandler2\Core;

/**
 * Interface Config
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
interface Config
{
    /**
     * get
     *
     * @param string $key
     * @param null   $default
     *
     * @return null|mixed
     */
    public function get($key, $default = null);

    /**
     * getAll
     *
     * @return array
     */
    public function getAll();
}
