<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Core\BasicConfig;
use RcmErrorHandler2\Core\ObserverConfig;
use RcmErrorHandler2\Core\RcmErrorHandler2Config;
use RcmErrorHandler2\Log\LoggerObserver;

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

        $loggerObserverConfig = $observerConfig->get(LoggerObserver::class, []);

        $configObject = new BasicConfig($loggerObserverConfig);

        new LoggerObserver(
            $configObject
        );
    }
}
