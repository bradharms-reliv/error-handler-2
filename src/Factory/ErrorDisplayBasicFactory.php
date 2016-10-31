<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\ErrorDisplay\ErrorDisplayBasic;

/**
 * Class ErrorDisplayBasicFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayBasicFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return ErrorDisplayBasic
     */
    public function __invoke($container)
    {
        return new ErrorDisplayBasic();
    }
}
