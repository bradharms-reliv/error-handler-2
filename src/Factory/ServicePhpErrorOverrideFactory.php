<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Core\RcmErrorHandler2Config;
use RcmErrorHandler2\Service\PhpErrorOverride;

/**
 * Class ServicePhpErrorOverrideFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ServicePhpErrorOverrideFactory
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
        return new PhpErrorOverride(
            $container,
            RcmErrorHandler2Config::class
        );
    }
}
