<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Service\RelivEnvironment;

/**
 * Class ServiceRelivEnvironmentFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ServiceRelivEnvironmentFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return RelivEnvironment
     */
    public function __invoke($container)
    {
        return new RelivEnvironment();
    }
}
