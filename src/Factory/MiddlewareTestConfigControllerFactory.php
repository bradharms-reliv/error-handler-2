<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\RcmErrorHandler2Config;
use RcmErrorHandler2\Middleware\TestConfigController;

/**
 * Class MiddlewareTestConfigControllerFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class MiddlewareTestConfigControllerFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return TestConfigController
     */
    public function __invoke($container)
    {
        /** @var RcmErrorHandler2Config $rcmErrorHandler2Config */
        $rcmErrorHandler2Config = $container->get(RcmErrorHandler2Config::class);

        return new TestConfigController(
            $rcmErrorHandler2Config
        );
    }
}
