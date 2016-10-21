<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Middleware\ErrorDisplayFinalDump;

/**
 * Class ErrorDisplayFinalDumpFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayFinalDumpFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return ErrorDisplayFinalDump
     */
    public function __invoke($container)
    {
        return new ErrorDisplayFinalDump();
    }
}
