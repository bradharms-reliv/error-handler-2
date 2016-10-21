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
     * getConfig
     *
     * @param string $key
     *
     * @return Config
     */
    public function getConfig($key);

    /**
     * toArray
     *
     * @return array
     */
    public function toArray();
}
