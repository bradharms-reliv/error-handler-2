<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
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
        /** @var Throwable $throwableHandler */
        $throwableHandler = $container->get(Throwable::class);

        return new FinalHandler(
            $throwableHandler
        );
    }
}
