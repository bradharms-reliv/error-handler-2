<?php
/**
 * error-handler-2.php
 */
return [
    /**
     * enable Exception overrides (false = off)
     */
    'overrideExceptions' => false,

    /**
     * enable Error overrides (false = off)
     */
    'overrideErrors' => false,

    'formatters' => [

    ],

    /**
     * Observers can be injected to listen for errors
     */
    'observers' => [
        /**
         * Standard Observers for logging errors using loggers
         */
        /* */
        \RcmErrorHandler2\Log\LoggerObserver::class => [
            // Logger Services to use
            'loggers' => [
                'RcmErrorHandler\Log\FileErrorLogger',
                //'RcmErrorHandler\Log\PhpErrorLogger',
                //'RcmErrorHandler\Log\VarDumpErrorLogger',
                //'Reliv\RcmJira\Log\JiraLogger',
                //'Reliv\RcmAxosoft\Log\AxosoftLogger',
            ],
            // Include Stacktrace - true to include stacktrace for loggers
            'includeStacktrace' => true,
        ],
        /* */
    ],
];

[
    /**
     * enable Exception overrides (false = off)
     */
    'overrideExceptions' => false,

    /**
     * enable Error overrides (false = off)
     */
    'overrideErrors' => false,

    /**
     * Error formatters,
     *
     * 'request/contentheader' => [
     *   'class' => '\Some\Formater\Class',
     *   'options' => ['formatter' => 'options'];
     * ]
     */
    'format' => [
        /**
         * Will over-ride system default if used
         */
        /* *
        '_default' => array(
            'class' => '\RcmErrorHandler\Format\FormatDefault',
            'options' => array(),
        ),
        /* */

        /**
         * Used for JSON formatting of errors if request is application/json
         *
         */
        'application/json' => [
            'class' => '\RcmErrorHandler\Format\FormatJson',
            'options' => [],
        ]
    ],

    /**
     * @deprecated Use Observers
     * Listeners can be injected to listen for errors
     */
    'listener' => [
        /**
         * Standard listener for logging errors using loggers
         */
        /* *
        '\RcmErrorHandler\Log\LoggerErrorListener' => [
            // Required event
            'event' => 'RcmErrorHandler::All',
            // Options
            'options' => [
                // Logger Services to use
                'loggers' => [
                    'RcmErrorHandler\Log\FileErrorLogger',
                    //'RcmErrorHandler\Log\PhpErrorLogger',
                    //'RcmErrorHandler\Log\VarDumpErrorLogger',
                    //'Reliv\RcmJira\Log\JiraLogger',
                    //'Reliv\RcmAxosoft\Log\AxosoftLogger',
                ],
                // Include Stacktrace - true to include stacktrace for loggers
                'includeStacktrace' => true,
            ],
        ],
        /* */
    ],
    /**
     * Observers can be injected to listen for errors
     */
    'observers' => [
        /**
         * Standard Observers for logging errors using loggers
         */
        /* *
        '\RcmErrorHandler\Log\LoggerErrorObserver' => [
            // Required event
            'event' => 'RcmErrorHandler::All',
            // Options
            'options' => [
                // Logger Services to use
                'loggers' => [
                    'RcmErrorHandler\Log\FileErrorLogger',
                    //'RcmErrorHandler\Log\PhpErrorLogger',
                    //'RcmErrorHandler\Log\VarDumpErrorLogger',
                    //'Reliv\RcmJira\Log\JiraLogger',
                    //'Reliv\RcmAxosoft\Log\AxosoftLogger',
                ],
                // Include Stacktrace - true to include stacktrace for loggers
                'includeStacktrace' => true,
            ],
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
];
