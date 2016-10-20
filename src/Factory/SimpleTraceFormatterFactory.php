<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Formatter\SimpleFormatter;
use RcmErrorHandler2\Formatter\SimpleTraceFormatter;

/**
 * Class SimpleTraceFormatterFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class SimpleTraceFormatterFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return SimpleTraceFormatter
     */
    public function __invoke($container)
    {
        /** @var ObserverConfig $observerConfig */
        $observerConfig = $container->get(ObserverConfig::class);

        $loggerObserverConfig = $observerConfig->get(LoggerObserver::class, []);

        $configObject = new BasicConfig($loggerObserverConfig);

        new SimpleTraceFormatter(
            $options,
        );
    }
}
