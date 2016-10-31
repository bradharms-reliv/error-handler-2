<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\ErrorDisplayConfig;
use RcmErrorHandler2\Config\ErrorDisplayFileConfig;
use RcmErrorHandler2\Config\RcmErrorHandler2Config;
use RcmErrorHandler2\ErrorDisplay\ErrorDisplayFile;

/**
 * Class ConfigErrorDisplayFileFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ConfigErrorDisplayFileFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return ErrorDisplayFileConfig
     */
    public function __invoke($container)
    {
        /** @var RcmErrorHandler2Config $rcmErrorHandler2Config */
        $rcmErrorHandler2Config = $container->get(RcmErrorHandler2Config::class);
        $config = $rcmErrorHandler2Config->get(ErrorDisplayFile::class, []);

        return new ErrorDisplayFileConfig(
            $config
        );
    }
}
