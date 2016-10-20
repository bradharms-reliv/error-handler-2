<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Core\BasicConfig;
use RcmErrorHandler2\Core\RcmErrorHandler2Config;

/**
 * Class RcmErrorHandler2ConfigFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class RcmErrorHandler2ConfigFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return BasicConfig
     */
    public function __invoke($container)
    {
        $config = $container->get('Config');

        $rcmErrorHandler2Config = [];

        if ($config['RcmErrorHandler2']) {
            $rcmErrorHandler2Config = $config['RcmErrorHandler2'];
        }

        return new RcmErrorHandler2Config(
            $rcmErrorHandler2Config
        );
    }
}
