<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\ObserverConfig;
use RcmErrorHandler2\Formatter\BasicSummaryFormatter;
use RcmErrorHandler2\Formatter\BasicTraceFormatter;
use RcmErrorHandler2\Observer\LoggerObserver;

/**
 * Class ObserverLoggerObserverFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ObserverLoggerObserverFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return LoggerObserver
     */
    public function __invoke($container)
    {
        /** @var ObserverConfig $observerConfig */
        $observerConfig = $container->get(ObserverConfig::class);
        $loggerObserverConfig = $observerConfig->getConfig(LoggerObserver::class);

        $summaryFormatter = $container->get(BasicSummaryFormatter::class);
        $traceFormatter = $container->get(BasicTraceFormatter::class);

        return new LoggerObserver(
            $loggerObserverConfig,
            $summaryFormatter,
            $traceFormatter,
            $container
        );
    }
}
