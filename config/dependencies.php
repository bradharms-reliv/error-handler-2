<?php
/**
 * dependencies.php
 */
return [
    \RcmErrorHandler2\Core\RcmErrorHandler2Config::class => \RcmErrorHandler2\Factory\RcmErrorHandler2ConfigFactory::class,
    \RcmErrorHandler2\Core\ObserverConfig::class => \RcmErrorHandler2\Factory\ObserverConfigFactory::class,
    /**
     * Default Formatters
     */
    \RcmErrorHandler2\Formatter\SummaryFormatter::class => \RcmErrorHandler2\Factory\SimpleFormatterFactory::class,
    \RcmErrorHandler2\Formatter\TraceFormatter::class => \RcmErrorHandler2\Factory\TraceFormatterFactory::class,
];
