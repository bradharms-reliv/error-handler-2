<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\ObserverConfig;
use RcmErrorHandler2\Formatter\SummaryFormatter;
use RcmErrorHandler2\Formatter\TraceFormatter;
use RcmErrorHandler2\Observer\LoggerObserver;

/**
 * Class LoggerObserverFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class LoggerObserverFactory
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

        $defaultSummaryFormatter = $container->get(SummaryFormatter::class);
        $defaultTraceFormatter = $container->get(TraceFormatter::class);

        return new LoggerObserver(
            $loggerObserverConfig,
            $defaultSummaryFormatter,
            $defaultTraceFormatter,
            $container
        );
    }
}
