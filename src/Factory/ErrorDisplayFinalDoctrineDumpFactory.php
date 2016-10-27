<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\ErrorDisplayConfig;
use RcmErrorHandler2\ErrorDisplay\ErrorDisplayFinalDoctrineDump;

/**
 * Class ErrorDisplayFinalDoctrineDumpFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayFinalDoctrineDumpFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return ErrorDisplayFinalDoctrineDump
     */
    public function __invoke($container)
    {
        $errorDisplayConfig = $container->get(ErrorDisplayConfig::class);

        return new ErrorDisplayFinalDoctrineDump(
            $errorDisplayConfig
        );
    }
}
