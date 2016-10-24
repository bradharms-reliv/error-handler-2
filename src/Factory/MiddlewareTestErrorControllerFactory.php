<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Middleware\TestErrorController;

/**
 * Class MiddlewareTestErrorControllerFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class MiddlewareTestErrorControllerFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return TestErrorController
     */
    public function __invoke($container)
    {
        return new TestErrorController();
    }
}
