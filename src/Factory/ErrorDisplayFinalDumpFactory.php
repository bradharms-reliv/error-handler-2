<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\ErrorDisplayConfig;
use RcmErrorHandler2\ErrorDisplay\ErrorDisplayFinalDump;

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
        $errorDisplayConfig = $container->get(ErrorDisplayConfig::class);

        return new ErrorDisplayFinalDump(
            $errorDisplayConfig
        );
    }
}
