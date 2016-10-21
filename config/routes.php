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
        'name' => 'test.rcm-error-handler-2-error',
        'path' => '/test/rcm-error-handler-2-error',
        'middleware' => \RcmErrorHandler2\Middleware\TestErrorController::class,
        'options' => [],
        'allowed_methods' => ['GET'],
    ],
    [
        'name' => 'test.rcm-error-handler-2-exception',
        'path' => '/test/rcm-error-handler-2-exception',
        'middleware' => \RcmErrorHandler2\Middleware\TestExceptionController::class,
        'options' => [],
        'allowed_methods' => ['GET'],
    ],
];
