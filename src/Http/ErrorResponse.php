<?php

namespace RcmErrorHandler2\Http;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface ErrorResponse
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
interface ErrorResponse extends ResponseInterface
{
    /**
     * stopNormalErrorHandling
     *
     * http://php.net/manual/en/function.set-error-handler.php
     * Per docs: If the function returns FALSE then the normal error handler continues
     *
     * @return bool
     */
    public function stopNormalErrorHandling();
}
