<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\ErrorDisplayFileConfig;
use RcmErrorHandler2\ErrorDisplay\ErrorDisplayFinalFile;

/**
 * Class ErrorDisplayFinalFileFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayFinalFileFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return ErrorDisplayFinalFile
     */
    public function __invoke($container)
    {
        $errorDisplayConfig = $container->get(ErrorDisplayFileConfig::class);

        return new ErrorDisplayFinalFile(
            $errorDisplayConfig
        );
    }
}
