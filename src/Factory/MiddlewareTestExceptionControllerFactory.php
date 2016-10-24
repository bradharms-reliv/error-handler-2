<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Middleware\TestExceptionController;

/**
 * Class MiddlewareTestExceptionControllerFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class MiddlewareTestExceptionControllerFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return TestExceptionController
     */
    public function __invoke($container)
    {
        return new TestExceptionController();
    }
}
