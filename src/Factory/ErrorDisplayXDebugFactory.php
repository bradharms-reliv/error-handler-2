<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\ErrorDisplay\ErrorDisplayXDebug;

/**
 * Class ErrorDisplayXDebugFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayXDebugFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return ErrorDisplayXDebug
     */
    public function __invoke($container)
    {
        return new ErrorDisplayXDebug();
    }
}
