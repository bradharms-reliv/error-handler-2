<?php

namespace RcmErrorHandler2\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RcmErrorHandler2\Config\RcmErrorHandler2Config;

/**
 * Class TestExceptionController
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class TestExceptionController
{
    /**
     * @var RcmErrorHandler2Config
     */
    protected $config;

    /**
     * TestConfigController constructor.
     *
     * @param RcmErrorHandler2Config $config
     */
    public function __construct(
        RcmErrorHandler2Config $config
    ) {
        $this->config = $config;
    }

    /**
     * __invoke
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param callable|null     $next
     *
     * @return mixed
     * @throws \Exception
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        if($this->config->get('testEnabled', false)) {
            return $response->withHeader('status', '404');
        }

        throw new \Exception('This is a test exception from: ' . get_class($this));

        return $next($request, $response);
    }
}
