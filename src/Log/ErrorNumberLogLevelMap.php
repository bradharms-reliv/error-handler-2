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
    public static $map = [
        E_NOTICE            => LogLevel::NOTICE,
        E_USER_NOTICE       => LogLevel::NOTICE,
        E_WARNING           => LogLevel::WARNING,
        E_CORE_WARNING      => LogLevel::WARNING,
        E_USER_WARNING      => LogLevel::WARNING,
        E_ERROR             => LogLevel::ERROR,
        E_USER_ERROR        => LogLevel::ERROR,
        E_CORE_ERROR        => LogLevel::ERROR,
        E_RECOVERABLE_ERROR => LogLevel::ERROR,
        E_PARSE             => LogLevel::ERROR,
        E_COMPILE_ERROR     => LogLevel::ERROR,
        E_COMPILE_WARNING   => LogLevel::ERROR,
        E_STRICT            => LogLevel::DEBUG,
        E_DEPRECATED        => LogLevel::DEBUG,
        E_USER_DEPRECATED   => LogLevel::DEBUG,
    ];

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
            $priority = self::$map[$errno];
        } else {
            $priority = LogLevel::INFO;
        }

        return $priority;
    }
}
