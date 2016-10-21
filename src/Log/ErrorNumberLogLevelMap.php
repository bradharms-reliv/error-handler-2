<?php

namespace RcmErrorHandler\Log;

use Psr\Log\LogLevel;

/**
 * Class ErrorNumberLogLevelMap
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorNumberLogLevelMap
{
    /**
     * Map native PHP error numbers to LogLevel
     *
     * @var array
     */
    protected static $map
        = [
            E_NOTICE => LogLevel::NOTICE,
            E_USER_NOTICE => LogLevel::NOTICE,
            E_WARNING => LogLevel::WARNING,
            E_CORE_WARNING => LogLevel::WARNING,
            E_USER_WARNING => LogLevel::WARNING,
            E_ERROR => LogLevel::ERROR,
            E_USER_ERROR => LogLevel::ERROR,
            E_CORE_ERROR => LogLevel::ERROR,
            E_RECOVERABLE_ERROR => LogLevel::ERROR,
            E_PARSE => LogLevel::ERROR,
            E_COMPILE_ERROR => LogLevel::ERROR,
            E_COMPILE_WARNING => LogLevel::ERROR,
            E_STRICT => LogLevel::DEBUG,
            E_DEPRECATED => LogLevel::DEBUG,
            E_USER_DEPRECATED => LogLevel::DEBUG,
        ];

    /**
     * Cache of flipped array
     *
     * @var array
     */
    protected static $mapFlip = null;

    /**
     * getPriority
     *
     * @param int $errno
     *
     * @return string
     */
    public static function getLogLevel($errno)
    {
        if (isset(self::$map[$errno])) {
            $logLevel = self::$map[$errno];
        } else {
            $logLevel = LogLevel::INFO;
        }

        return $logLevel;
    }

    /**
     * getErrorNo
     *
     * @param string $logLevel
     *
     * @return int
     */
    public static function getErrorNo($logLevel)
    {
        if (empty(self::$mapFlip)) {
            self::$mapFlip = array_flip(self::$map);
        }

        if (isset(self::$mapFlip[$logLevel])) {
            $errno = self::$mapFlip[$logLevel];
        } else {
            $errno = E_USER_ERROR;
        }

        return $errno;
    }
}
