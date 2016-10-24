<?php

namespace RcmErrorHandler2\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RcmErrorHandler2\Handler\Throwable;
use RcmErrorHandler2\Http\BasicErrorResponse;
use RcmErrorHandler2\Service\ErrorServerRequestFactory;

/**
 * Class FinalHandler
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class FinalHandler
{
    /**
     * @var Throwable
     */
    protected $handler;

    /**
     * FinalHandler constructor.
     *
     * @param Throwable $handler
     */
    public function __construct(Throwable $handler)
    {
        $this->handler = $handler;
    }

    /**
     * __invoke
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param null              $err
     *
     * @return ResponseInterface
     * @throws \Throwable
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, $err = null)
    {
        if (!$err) {
            return $response;
        }

        if ($err instanceof \Exception || $err instanceof \Throwable) {

            $errorException = $this->handler->getErrorException($err);

            $errorException->setHandler(static::class);

            $errorRequest = ErrorServerRequestFactory::errorRequestFromGlobals(
                $errorException
            );

            $errorResponse = new BasicErrorResponse(
                'php://memory',
                500,
                []
            );

            $response = $this->handler->notify($errorRequest, $errorResponse);
            return $response;
        }

        // @todo Could handle the case better
        $content = json_encode($err, JSON_PRETTY_PRINT);
        $body = $response->getBody();
        $body->write("FinalError: \n" . $content);

        return $response->withBody($body);
    }
}
