<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\ErrorDisplayConfig;
use RcmErrorHandler2\ErrorDisplay\ErrorDisplayFinalBasic;

/**
 * Class ErrorDisplayFinalFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayFinalBasicFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return ErrorDisplayFinalBasic
     */
    public function __invoke($container)
    {
        $errorDisplayConfig = $container->get(ErrorDisplayConfig::class);

        return new ErrorDisplayFinalBasic(
            $errorDisplayConfig
        );
    }
}
