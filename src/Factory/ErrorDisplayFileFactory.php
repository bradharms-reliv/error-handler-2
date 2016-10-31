<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\ErrorDisplayFileConfig;
use RcmErrorHandler2\ErrorDisplay\ErrorDisplayFile;

/**
 * Class ErrorDisplayFileFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayFileFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return ErrorDisplayFile
     */
    public function __invoke($container)
    {
        $errorDisplayConfig = $container->get(ErrorDisplayFileConfig::class);

        return new ErrorDisplayFile(
            $errorDisplayConfig
        );
    }
}
