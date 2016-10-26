<?php
/**
 * routes.php
 */
return [
    [
        'name' => 'api.rcm-error-handler-2.client-error',
        'path' => '/api/rcm-error-handler-2/client-error',
        'middleware' => [
            \Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware::class,
            \RcmErrorHandler2\Middleware\ClientErrorLoggerController::class,
        ],
        'options' => [],
        'allowed_methods' => ['POST'],
    ],
    [
        'name' => 'api.rcm-error-handler-2.client-error',
        'path' => '/rcm-error-handler-2/client-error.js',
        'middleware' => \RcmErrorHandler2\Middleware\ClientErrorLoggerJsController::class,
        'options' => [],
        'allowed_methods' => ['GET'],
    ],
    [
        'name' => 'rcm-error-handler-2.test.config',
        'path' => '/rcm-error-handler-2/test/config',
        'middleware' => \RcmErrorHandler2\Middleware\TestConfigController::class,
        'options' => [],
        'allowed_methods' => ['GET'],
    ],
    [
        'name' => 'rcm-error-handler-2.test.error',
        'path' => '/rcm-error-handler-2/test/error',
        'middleware' => \RcmErrorHandler2\Middleware\TestErrorController::class,
        'options' => [],
        'allowed_methods' => ['GET'],
    ],
    [
        'name' => 'rcm-error-handler-2.test.exception',
        'path' => '/rcm-error-handler-2/test/exception',
        'middleware' => \RcmErrorHandler2\Middleware\TestExceptionController::class,
        'options' => [],
        'allowed_methods' => ['GET'],
    ],
    [
        'name' => 'rcm-error-handler-2.test.warning',
        'path' => '/rcm-error-handler-2/test/warning',
        'middleware' => \RcmErrorHandler2\Middleware\TestWarningController::class,
        'options' => [],
        'allowed_methods' => ['GET'],
    ],
];
