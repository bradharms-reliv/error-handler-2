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
        \RcmErrorHandler2\Config\ErrorDisplayMiddlewareConfig::class
        => \RcmErrorHandler2\Factory\ConfigErrorDisplayMiddlewareConfigFactory::class,
        \RcmErrorHandler2\Config\ErrorResponseConfig::class
        => \RcmErrorHandler2\Factory\ConfigErrorResponseConfigFactory::class,
        \RcmErrorHandler2\Config\ObserverConfig::class
        => \RcmErrorHandler2\Factory\ConfigObserverConfigFactory::class,
        \RcmErrorHandler2\Config\RcmErrorHandler2Config::class
        => \RcmErrorHandler2\Factory\ConfigRcmErrorHandler2ConfigFactory::class,

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

        // Others
        \RcmErrorHandler2\Formatter\HtmlFormatter::class
        => \RcmErrorHandler2\Factory\FormatterHtmlFormatterFactory::class,
        \RcmErrorHandler2\Formatter\HtmlSummaryFormatter::class
        => \RcmErrorHandler2\Factory\FormatterHtmlSummaryFormatterFactory::class,
        \RcmErrorHandler2\Formatter\HtmlTraceFormatter::class
        => \RcmErrorHandler2\Factory\FormatterHtmlTraceFormatterFactory::class,

        /**
         * Handlers
         */
        \RcmErrorHandler2\Handler\Error::class
        => \RcmErrorHandler2\Factory\HandlerErrorFactory::class,
        \RcmErrorHandler2\Handler\Throwable::class
        => \RcmErrorHandler2\Factory\HandlerThrowableFactory::class,
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
         * Final Display Default
         */
        \RcmErrorHandler2\Middleware\ErrorDisplayFinal::class
        => \RcmErrorHandler2\Factory\ErrorDisplayFinalBasicFactory::class,

        /**
         * Middleware
         */
        // ErrorDisplay
        \RcmErrorHandler2\Middleware\ErrorDisplayFinalBasic::class
        => \RcmErrorHandler2\Factory\ErrorDisplayFinalBasicFactory::class,
        \RcmErrorHandler2\Middleware\ErrorDisplayFinalDump::class
        => \RcmErrorHandler2\Factory\ErrorDisplayFinalDumpFactory::class,
        \RcmErrorHandler2\Middleware\ErrorDisplayFormatted::class
        => \RcmErrorHandler2\Factory\ErrorDisplayFormattedFactory::class,
        \RcmErrorHandler2\Middleware\ErrorDisplayJson::class
        => \RcmErrorHandler2\Factory\ErrorDisplayJsonFactory::class,
        //
        \RcmErrorHandler2\Middleware\FinalHandler::class
        => \RcmErrorHandler2\Factory\MiddlewareFinalHandlerFactory::class,
        \RcmErrorHandler2\Middleware\PhpErrorOverride::class
        => \RcmErrorHandler2\Factory\MiddlewarePhpErrorOverrideFactory::class,

        \RcmErrorHandler2\Middleware\TestConfigController::class
        => \RcmErrorHandler2\Factory\MiddlewareTestConfigControllerFactory::class,
        \RcmErrorHandler2\Middleware\TestErrorController::class
        => \RcmErrorHandler2\Factory\MiddlewareTestErrorControllerFactory::class,
        \RcmErrorHandler2\Middleware\TestExceptionController::class
        => \RcmErrorHandler2\Factory\MiddlewareTestExceptionControllerFactory::class,

        /**
         * Services
         */
        \RcmErrorHandler2\Service\PhpErrorOverride::class
        => \RcmErrorHandler2\Factory\ServicePhpErrorOverrideFactory::class,
        \RcmErrorHandler2\Service\Environment::class
        => \RcmErrorHandler2\Factory\ServiceRelivEnvironmentFactory::class,
    ],
];
