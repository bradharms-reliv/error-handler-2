<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Formatter\SimpleFormatter;

/**
 * Class SimpleFormatterFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class SimpleFormatterFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return SimpleFormatter
     */
    public function __invoke($container)
    {
        $configObject = new BasicConfig($loggerObserverConfig);

        new SimpleFormatter(
            $options,

        );
    }
}
