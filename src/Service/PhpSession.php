<?php

namespace RcmErrorHandler2\Service;

/**
 * Class PhpSession
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class PhpSession
{
    /**
     * getSessionVars
     *
     * @return mixed
     */
    public static function getSessionVars()
    {
        return $_SESSION;
    }
}
