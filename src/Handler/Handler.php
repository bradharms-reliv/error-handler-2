<?php

namespace RcmErrorHandler2\Handler;

use RcmErrorHandler2\Http\ErrorRequest;
use RcmErrorHandler2\Http\ErrorResponse;
use RcmErrorHandler2\Observer\ObserverSubject;

/**
 * Interface Handler
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
interface Handler extends ObserverSubject
{
    /**
     * notify
     *
     * @param ErrorRequest  $request
     * @param ErrorResponse $response
     *
     * @return ErrorResponse
     */
    public function notify(ErrorRequest $request, ErrorResponse $response);

    /**
     * getResponse
     * NOTE: Returns ErrorResponse or echo and exit(1)
     *
     * @param ErrorRequest  $request
     * @param ErrorResponse $response
     *
     * @return ErrorResponse or echo and exit(1)
     */
    public function getResponse(ErrorRequest $request, ErrorResponse $response);

    /**
     * display
     *
     * @param ErrorResponse $response
     *
     * @return mixed
     */
    public function display(ErrorResponse $response);
}
