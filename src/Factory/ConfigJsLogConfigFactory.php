<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\JsLogConfig;
use RcmErrorHandler2\Config\RcmErrorHandler2Config;

/**
 * Class ConfigJsLogConfigFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ConfigJsLogConfigFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return JsLogConfig
     */
    public function __invoke($container)
    {
        /** @var RcmErrorHandler2Config $rcmErrorHandler2Config */
        $rcmErrorHandler2Config = $container->get(RcmErrorHandler2Config::class);

        $config = $rcmErrorHandler2Config->get('jsLogConfig', []);
        
        return new JsLogConfig(
            $config
        );
    }
}
