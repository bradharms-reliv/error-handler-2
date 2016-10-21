<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Middleware\PhpErrorOverride;

/**
 * Class MiddlewarePhpErrorOverrideFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class MiddlewarePhpErrorOverrideFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return PhpErrorOverride
     */
    public function __invoke($container)
    {
        $phpErrorOverrideService = $container->get(\RcmErrorHandler2\Service\PhpErrorOverride::class);

        return new PhpErrorOverride(
            $phpErrorOverrideService
        );
    }
}
