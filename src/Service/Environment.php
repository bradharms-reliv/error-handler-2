<?php

namespace RcmErrorHandler2\Service;

/**
 * Class Environment
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
interface Environment
{
    /**
     * isProduction
     *
     * @return bool
     */
    public function isProduction();
}
