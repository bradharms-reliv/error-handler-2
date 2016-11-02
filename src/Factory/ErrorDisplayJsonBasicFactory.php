<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\ErrorResponseConfig;
use RcmErrorHandler2\ErrorDisplay\ErrorDisplayJson;
use RcmErrorHandler2\ErrorDisplay\ErrorDisplayJsonBasic;

/**
 * Class ErrorDisplayJsonBasicFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayJsonBasicFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return ErrorDisplayJsonBasic
     */
    public function __invoke($container)
    {
        /** @var ErrorResponseConfig $errorResponseConfig */
        $errorResponseConfig = $container->get(ErrorResponseConfig::class);

        return new ErrorDisplayJsonBasic(
            $errorResponseConfig
        );
    }
}
