<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Core\ErrorDisplayMiddlewareConfig;
use RcmErrorHandler2\Core\ObserverConfig;
use RcmErrorHandler2\Handler\BasicError;
use RcmErrorHandler2\Middleware\ErrorDisplayFinal;

/**
 * Class HandlerErrorFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class HandlerErrorFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return BasicError
     */
    public function __invoke($container)
    {
        /** @var ObserverConfig $observerConfig */
        $observerConfig = $container->get(ObserverConfig::class);
        /** @var ErrorDisplayMiddlewareConfig $errorDisplayMiddleware */
        $errorDisplayMiddleware = $container->get(ErrorDisplayMiddlewareConfig::class);
        /** @var ErrorDisplayFinal $errorDisplayFinal */
        $errorDisplayFinal = $container->get(\RcmErrorHandler2\Middleware\ErrorDisplayFinalBasic::class);

        return new BasicError(
            $observerConfig->toArray(),
            $errorDisplayMiddleware->toArray(),
            $errorDisplayFinal
        );
    }
}
