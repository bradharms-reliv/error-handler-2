<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\JsLogConfig;
use RcmErrorHandler2\Middleware\ClientErrorLoggerJsController;

/**
 * Class MiddlewareClientErrorJsControllerFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class MiddlewareClientErrorJsControllerFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return ClientErrorLoggerJsController
     */
    public function __invoke($container)
    {
        return new ClientErrorLoggerJsController(
            $container->get(JsLogConfig::class)
        );
    }
}
