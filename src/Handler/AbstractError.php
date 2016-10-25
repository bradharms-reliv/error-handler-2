<?php

namespace RcmErrorHandler2\Handler;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\ErrorResponseConfig;
use RcmErrorHandler2\Exception\ErrorException;
use RcmErrorHandler2\Http\BasicErrorResponse;
use RcmErrorHandler2\Middleware\ErrorDisplayFinal;
use RcmErrorHandler2\Service\ErrorExceptionBuilder;
use RcmErrorHandler2\Service\ErrorServerRequestFactory;
use RcmErrorHandler2\Service\PhpErrorSettings;

/**
 * Class AbstractError
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class AbstractError extends AbstractHandler implements Error
{
    /**
     * handle
     *
     * @param int    $errno
     * @param int    $errstr
     * @param string $errfile
     * @param int    $errline
     * @param array  $errcontext
     *
     * @return bool
     */
    public function handle(
        $errno = 0,
        $errstr = 1,
        $errfile = __FILE__,
        $errline = __LINE__,
        $errcontext = []
    ) {
        // @todo This might not be what we want, this will not log
        if (!PhpErrorSettings::canReportErrors($errno)) {
            // This error code is not included in error_reporting
            return false;
        }

        $errorException = $this->getErrorException(
            $errno,
            $errstr,
            $errfile,
            $errline,
            $errcontext
        );

        $request = ErrorServerRequestFactory::errorRequestFromGlobals(
            $errorException
        );

        $response = new BasicErrorResponse(
            $this->errorResponseConfig->get('body'),
            $this->errorResponseConfig->get('status'),
            $this->errorResponseConfig->get('headers')
        );

        $errorResponse = $this->notify($request, $response);

        $this->display($errorResponse);

        // @todo This logic might not be what we want
        // Return false: PHP: If the function returns FALSE then the normal error handler continues.
        return $errorResponse->stopNormalErrorHandling();
    }

    /**
     * getErrorException
     *
     * @param int    $errno   severity
     * @param int    $errstr  message
     * @param string $errfile file
     * @param int    $errline line
     * @param array  $errcontext
     *
     * @return ErrorException
     */
    public function getErrorException(
        $errno = 0,
        $errstr = 1,
        $errfile = __FILE__,
        $errline = __LINE__,
        $errcontext = []
    ) {
        return ErrorExceptionBuilder::buildFromError(
            $errno,
            $errstr,
            $errfile,
            $errline,
            $errcontext,
            static::class
        );
    }
}
