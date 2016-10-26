<?php
/**
 * dependencies.php
 */
return [
    'invokables' => [
        \Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware::class
        => \Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware::class,
    ],
    'factories' => [
        /**
         * Config
         */
        \RcmErrorHandler2\Config\DefaultFormatterConfig::class
        => \RcmErrorHandler2\Factory\ConfigDefaultFormatterConfigFactory::class,
        // ErrorDisplayConfig
        \RcmErrorHandler2\Config\ErrorDisplayConfig::class
        => \RcmErrorHandler2\Factory\ConfigErrorDisplayConfigFactory::class,
        // ErrorDisplayMiddlewareConfig
        \RcmErrorHandler2\Config\ErrorDisplayMiddlewareConfig::class
        => \RcmErrorHandler2\Factory\ConfigErrorDisplayMiddlewareConfigFactory::class,
        // ErrorResponseConfig
        \RcmErrorHandler2\Config\ErrorResponseConfig::class
        => \RcmErrorHandler2\Factory\ConfigErrorResponseConfigFactory::class,
        // ObserverConfig
        \RcmErrorHandler2\Config\ObserverConfig::class
        => \RcmErrorHandler2\Factory\ConfigObserverConfigFactory::class,
        // RcmErrorHandler2Config
        \RcmErrorHandler2\Config\RcmErrorHandler2Config::class
        => \RcmErrorHandler2\Factory\ConfigRcmErrorHandler2ConfigFactory::class,

        /**
         * Final Display Default - Over-ride this for different final display
         */
        \RcmErrorHandler2\ErrorDisplay\ErrorDisplayFinal::class
        => \RcmErrorHandler2\Factory\ErrorDisplayFinalBasicFactory::class,

        /**
         * ErrorDisplay Middleware
         */
        // ErrorDisplayFinalBasic
        \RcmErrorHandler2\ErrorDisplay\ErrorDisplayFinalBasic::class
        => \RcmErrorHandler2\Factory\ErrorDisplayFinalBasicFactory::class,
        // ErrorDisplayFinalDump
        \RcmErrorHandler2\ErrorDisplay\ErrorDisplayFinalDump::class
        => \RcmErrorHandler2\Factory\ErrorDisplayFinalDumpFactory::class,
        // ErrorDisplayFormatted
        \RcmErrorHandler2\ErrorDisplay\ErrorDisplayFormatted::class
        => \RcmErrorHandler2\Factory\ErrorDisplayFormattedFactory::class,
        // ErrorDisplayJson
        \RcmErrorHandler2\ErrorDisplay\ErrorDisplayJson::class
        => \RcmErrorHandler2\Factory\ErrorDisplayJsonFactory::class,
        // ErrorDisplayXDebug
        \RcmErrorHandler2\ErrorDisplay\ErrorDisplayXDebug::class
        => \RcmErrorHandler2\Factory\ErrorDisplayXDebugFactory::class,

        /**
         * Formatter Services
         */
        // Formatter Default
        \RcmErrorHandler2\Formatter\Formatter::class
        => \RcmErrorHandler2\Factory\FormatterHtmlFormatterFactory::class,
        // SummaryFormatter Default
        \RcmErrorHandler2\Formatter\SummaryFormatter::class
        => \RcmErrorHandler2\Factory\FormatterHtmlSummaryFormatterFactory::class,
        // TraceFormatter Default
        \RcmErrorHandler2\Formatter\TraceFormatter::class
        => \RcmErrorHandler2\Factory\FormatterHtmlTraceFormatterFactory::class,

        // BasicSummaryFormatter
        \RcmErrorHandler2\Formatter\BasicSummaryFormatter::class
        => \RcmErrorHandler2\Factory\FormatterBasicSummaryFormatterFactory::class,
        // BasicTraceFormatter
        \RcmErrorHandler2\Formatter\BasicTraceFormatter::class
        => \RcmErrorHandler2\Factory\FormatterBasicTraceFormatterFactory::class,
        // HtmlFormatter
        \RcmErrorHandler2\Formatter\HtmlFormatter::class
        => \RcmErrorHandler2\Factory\FormatterHtmlFormatterFactory::class,
        // HtmlSummaryFormatter
        \RcmErrorHandler2\Formatter\HtmlSummaryFormatter::class
        => \RcmErrorHandler2\Factory\FormatterHtmlSummaryFormatterFactory::class,
        // HtmlTraceFormatter
        \RcmErrorHandler2\Formatter\HtmlTraceFormatter::class
        => \RcmErrorHandler2\Factory\FormatterHtmlTraceFormatterFactory::class,

        /**
         * Handlers
         */
        // Error
        \RcmErrorHandler2\Handler\Error::class
        => \RcmErrorHandler2\Factory\HandlerErrorFactory::class,
        // Throwable
        \RcmErrorHandler2\Handler\Throwable::class
        => \RcmErrorHandler2\Factory\HandlerThrowableFactory::class,
        // ZfThrowable
        \RcmErrorHandler2\Handler\ZfThrowable::class
        => \RcmErrorHandler2\Factory\HandlerZfThrowableFactory::class,

        /**
         * Emitters
         */
        'RcmErrorHandler2\Http\Emitter'
        => \RcmErrorHandler2\Factory\HttpExpressiveEmitterFactory::class,

        /**
         * Loggers
         */
        \RcmErrorHandler2\Log\FileErrorLogger::class
        => \RcmErrorHandler2\Factory\LogFileErrorLoggerFactory::class,

        /**
         * Observers
         */
        \RcmErrorHandler2\Observer\LoggerObserver::class
        => \RcmErrorHandler2\Factory\ObserverLoggerObserverFactory::class,

        /**
         * Middleware
         */
        // ClientErrorLoggerController
        \RcmErrorHandler2\Middleware\ClientErrorLoggerController::class
        => \RcmErrorHandler2\Factory\MiddlewareClientErrorControllerFactory::class,
        // FinalHandler
        \RcmErrorHandler2\Middleware\FinalHandler::class
        => \RcmErrorHandler2\Factory\MiddlewareFinalHandlerFactory::class,
        // PhpErrorOverride
        \RcmErrorHandler2\Middleware\PhpErrorOverride::class
        => \RcmErrorHandler2\Factory\MiddlewarePhpErrorOverrideFactory::class,
        // TestConfigController
        \RcmErrorHandler2\Middleware\TestConfigController::class
        => \RcmErrorHandler2\Factory\MiddlewareTestConfigControllerFactory::class,
        // TestErrorController
        \RcmErrorHandler2\Middleware\TestErrorController::class
        => \RcmErrorHandler2\Factory\MiddlewareTestErrorControllerFactory::class,
        // TestExceptionController
        \RcmErrorHandler2\Middleware\TestExceptionController::class
        => \RcmErrorHandler2\Factory\MiddlewareTestExceptionControllerFactory::class,
        // TestWarningController
        \RcmErrorHandler2\Middleware\TestWarningController::class
        => \RcmErrorHandler2\Factory\MiddlewareTestWarningControllerFactory::class,

        /**
         * Services
         */
        // PhpErrorOverride
        \RcmErrorHandler2\Service\PhpErrorOverride::class
        => \RcmErrorHandler2\Factory\ServicePhpErrorOverrideFactory::class,
        // Environment: Over-ride this for different server environment
        \RcmErrorHandler2\Service\Environment::class
        => \RcmErrorHandler2\Factory\ServiceRelivEnvironmentFactory::class,
    ],
];
