<?php
/**
 * error-handler-2.php
 */
return [
    /**
     * enable Error overrides (false = off)
     */
    'overrideErrors' => false,

    /**
     * enable Exception overrides (false = off)
     */
    'overrideExceptions' => false,

    /**
     * enable Zend Framework Exception overrides (false = off)
     */
    'overrideZfExceptions' => false,

    /**
     * Default formatter general options
     */
    'defaultFormatter' => [

    ],

    /**
     * ErrorDisplay general options
     */
    'errorDisplay' => [
        'finalMessage' => 'An error occurred.',
    ],

    /**
     * General Handler Options
     */
    'errorResponse' => [
        'body' => 'php://memory', // stream
        'status' => 500, // status code
        'headers' => [], // ['{name}' => ['value1', 'value2' ...]]
    ],

    /**
     * errorDisplayMiddleware This middleware is for displaying errors ONLY
     * - Each middleware can check if it wants to display the error and return a response
     * - Or call next if it does not display the error
     */
    'errorDisplayMiddleware' => [
        // \RcmErrorHandler2\ErrorDisplay\ErrorDisplayJson::class => \RcmErrorHandler2\ErrorDisplay\ErrorDisplayJson::class,
        // \RcmErrorHandler2\ErrorDisplay\ErrorDisplayFormatted::class => \RcmErrorHandler2\ErrorDisplay\ErrorDisplayFormatted::class,
        // NOT COMPLETE: \RcmErrorHandler2\ErrorDisplay\ErrorDisplayXDebug::class => \RcmErrorHandler2\ErrorDisplay\ErrorDisplayXDebug::class
    ],

    /**
     * Observers can be injected to listen for errors
     */
    'observers' => [
        /**
         * Standard Observers for logging errors using loggers
         */
        /* */
        \RcmErrorHandler2\Observer\LoggerObserver::class => [
            // Logger Services to use
            'loggers' => [
                //RcmErrorHandler2\Log\FileErrorLogger::class,
                //RcmErrorHandler2\Log\PhpErrorLogger::class,
                //RcmErrorHandler\Log\VarDumpErrorLogger::class,
                //Reliv\RcmJira\Log\JiraLoggerPsr::class,
                //Reliv\RcmAxosoft\Log\AxosoftLoggerPsr::class',
            ],
            // Include Stacktrace - true to include stacktrace for loggers
            'includeStacktrace' => true,
            // traceFormatter run-time Options
            'traceFormatter' => [],
            // summaryFormatter run-time Options
            'summaryFormatter' => [],
        ],
        /* */
    ],

    /**
     * Define if logging is turned on.
     * Define the allowed routes to be logged
     */
    'jsLogConfig' => [
        'options' => [
            'logJsErrors' => false,
            'validRoutes' => [
                /**
                 * Regex for the start of the path
                 */
                // '/(\A)\/vendor\/.*/',
                // '/(\A)\/modules\/.*/',
            ],
        ],
        /**
         * Define which loggers to use for JS logging
         */
        'jsLoggers' => [
            //RcmErrorHandler2\Log\FileErrorLogger::class,
            //RcmErrorHandler2\Log\PhpErrorLogger::class,
            //RcmErrorHandler\Log\VarDumpErrorLogger::class,
            //Reliv\RcmJira\Log\JiraLoggerPsr::class,
            //Reliv\RcmAxosoft\Log\AxosoftLoggerPsr::class',
        ],
    ],

    /**
     * FileErrorLogger Options
     */
    \RcmErrorHandler2\Log\FileErrorLogger::class => [
        'fileLogPath' => 'data/Logs',
        'fileName' => 'rcm-error-handler-2-log',
    ],

    /**
     * PhpErrorLogger Options
     */
    RcmErrorHandler2\Log\PhpErrorLogger::class => [
        'error_log_message_type' => 0,
    ],
    /**
     * VarDumpErrorLogger Options
     */
    RcmErrorHandler2\Log\VarDumpErrorLogger::class => [
    ],
];
