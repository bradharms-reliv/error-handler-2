<?php

namespace RcmErrorHandler2\Service;

/**
 * Class PhpErrorSettings
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class PhpErrorSettings
{
    /**
     * canDisplayErrors
     *
     * @return string
     */
    public static function canDisplayErrors()
    {
        $display_errors = ini_get('display_errors');

        // @todo this is a hack for incorrect ini values
        if ($display_errors === 'On') {
            return true;
        }

        if ($display_errors === 'Off') {
            return false;
        }

        return (boolean)(int)$display_errors;
    }

    /**
     * canReportErrors
     *
     * @return bool
     */
    public static function canReportErrors($errno)
    {
        $reportingLevel = self::getErrorReporting();

        return (($reportingLevel & $errno) > 0);
    }

    /**
     * getErrorReporting
     *
     * @return int
     */
    public static function getErrorReporting()
    {
        return error_reporting();
    }
}
