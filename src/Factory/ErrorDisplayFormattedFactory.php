<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\DefaultFormatterConfig;
use RcmErrorHandler2\Formatter\Formatter;
use RcmErrorHandler2\Middleware\ErrorDisplayFormatted;

/**
 * Class ErrorDisplayFormattedFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayFormattedFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return ErrorDisplayFormatted
     */
    public function __invoke($container)
    {
        $defaultFormatter = $container->get(Formatter::class);
        $defaultFormatterConfig = $container->get(DefaultFormatterConfig::class);

        return new ErrorDisplayFormatted(
            $defaultFormatter,
            $defaultFormatterConfig
        );
    }
}
