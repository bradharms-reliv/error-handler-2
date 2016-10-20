<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Core\BasicConfig;
use RcmErrorHandler2\Core\ObserverConfig;
use RcmErrorHandler2\Core\RcmErrorHandler2Config;

/**
 * Class ObserverConfigFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ObserverConfigFactory
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
