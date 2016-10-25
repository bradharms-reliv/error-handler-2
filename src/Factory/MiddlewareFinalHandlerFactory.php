<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\ErrorResponseConfig;
use RcmErrorHandler2\Config\RcmErrorHandler2Config;
use RcmErrorHandler2\Handler\Throwable;
use RcmErrorHandler2\Middleware\FinalHandler;

/**
 * Class MiddlewareFinalHandlerFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class MiddlewareFinalHandlerFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return FinalHandler
     */
    public function __invoke($container)
    {
        /** @var RcmErrorHandler2Config $config */
        $config = $container->get(RcmErrorHandler2Config::class);

        /** @var ErrorResponseConfig $errorResponseConfig */
        $errorResponseConfig = $container->get(ErrorResponseConfig::class);

        /** @var Throwable $throwableHandler */
        $throwableHandler = $container->get(Throwable::class);

        return new FinalHandler(
            $config,
            $errorResponseConfig,
            $throwableHandler
        );
    }
}
