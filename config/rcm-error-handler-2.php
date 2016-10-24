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
     * Options for the default formatter
     */
    'defaultFormatter' => [

    ],

    /**
     * General Handler Options
     */
    \RcmErrorHandler2\Handler\Handler::class => [
        'serverErrorStatusCode' => 500,
    ],

    /**
     * errorDisplayMiddleware This middleware is for displaying errors ONLY
     * - Each middleware can check if it wants to display the error and return a response
     * - Or call next if it does not display the error
     */
    'errorDisplayMiddleware' => [
        \RcmErrorHandler2\Middleware\ErrorDisplayJson::class,
        \RcmErrorHandler2\Middleware\ErrorDisplayFormatted::class,
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
                RcmErrorHandler2\Log\FileErrorLogger::class,
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
            /**
             * Use JiraLogger service
             */
            // 'Reliv\RcmJira\Log\JiraLogger',

            /**
             * Use AxosoftLogger service
             */
            // 'Reliv\RcmAxosoft\Log\AxosoftLogger',

            /**
             * General Loggers
             */
            /* *
             'RcmErrorHandler\Log\PhpErrorLogger'
             'RcmErrorHandler\Log\VarDumpErrorLogger'
            /* */
        ],
    ],

    /**
     * FileErrorLogger Options
     */
    \RcmErrorHandler2\Log\FileErrorLogger::class => [
        'fileLogPath' => 'data/Logs',
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
    RcmErrorHandler\Log\VarDumpErrorLogger::class => [
    ],
];
