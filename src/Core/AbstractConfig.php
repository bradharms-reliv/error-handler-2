<?php

namespace RcmErrorHandler2\Core;

/**
 * Abstract Class BasicConfig
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   moduleNameHere
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
abstract class AbstractConfig implements Config
{
    /**
     * @var array $configArray
     */
    protected $configArray = [];

    /**
     * __construct
     *
     * @param array $configArray
     */
    public function __construct($configArray)
    {
        if (is_array($configArray)) {
            $this->configArray = $configArray;
        }
    }

    /**
     * get
     *
     * @param string $key
     * @param null   $default
     *
     * @return null
     */
    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->configArray)) {

            return $this->configArray[$key];
        }

        return $default;
    }

    /**
     * toArray
     *
     * @return array
     */
    public function toArray()
    {
        return $this->configArray;
    }
} 
