<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Middleware\ClientErrorLoggerController;

/**
 * Class MiddlewareClientErrorControllerFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class MiddlewareClientErrorControllerFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return ClientErrorLoggerController
     */
    public function __invoke($container)
    {
        return new ClientErrorLoggerController(
            $container
        );
    }
}
