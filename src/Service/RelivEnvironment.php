<?php

namespace RcmErrorHandler2\Service;

/**
 * Class RelivEnvironment
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class RelivEnvironment implements Environment
{
    /**
     * isProduction
     *
     * @return bool
     */
    public function isProduction()
    {
        return \Reliv\Server\Environment::isProduction();
    }
}
