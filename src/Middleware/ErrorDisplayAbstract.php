<?php

namespace RcmErrorHandler2\Middleware;

/**
 * Class ErrorDisplayAbstract
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
abstract class ErrorDisplayAbstract implements ErrorDisplay
{
    /**
     * getName
     *
     * @return string
     */
    public function getName()
    {
        return static::class;
    }
}
