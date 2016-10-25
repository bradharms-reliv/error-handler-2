<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\BasicConfig;
use RcmErrorHandler2\Config\ObserverConfig;
use RcmErrorHandler2\Config\RcmErrorHandler2Config;

/**
 * Class ConfigObserverConfigFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ConfigObserverConfigFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return ObserverConfig
     */
    public function __invoke($container)
    {
        /** @var RcmErrorHandler2Config $rcmErrorHandler2Config */
        $rcmErrorHandler2Config = $container->get(RcmErrorHandler2Config::class);

        $observerConfig = $rcmErrorHandler2Config->get('observers', []);
        
        return new ObserverConfig(
            $observerConfig
        );
    }
}
