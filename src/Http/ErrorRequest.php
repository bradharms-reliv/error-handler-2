<?php

namespace RcmErrorHandler2\Http;

use Psr\Http\Message\ServerRequestInterface;
use RcmErrorHandler2\Exception\ErrorException;

/**
 * Interface ErrorRequest
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
interface ErrorRequest extends ServerRequestInterface
{
    /**
     * withError
     *
     * @return ErrorRequest
     */
    public function withError(ErrorException $errorException);

    /**
     * getError
     *
     * @return ErrorException
     */
    public function getError();
}
