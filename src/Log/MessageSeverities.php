<?php

namespace RcmErrorHandler\Log;

/**
 * Class MessageSeverities
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class MessageSeverities
{
    /**
     * @const int defined from the BSD Syslog message severities
     * @link http://tools.ietf.org/html/rfc3164
     */
    const EMERG  = 0;
    const ALERT  = 1;
    const CRIT   = 2;
    const ERR    = 3;
    const WARN   = 4;
    const NOTICE = 5;
    const INFO   = 6;
    const DEBUG  = 7;
}
