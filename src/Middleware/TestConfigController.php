<?php

namespace RcmErrorHandler2\Middleware;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\RcmErrorHandler2Config;
use RcmErrorHandler2\Service\Environment;
use Zend\Stratigility\Http\Request;
use Zend\Stratigility\Http\Response;

/**
 * Class TestConfigController
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class TestConfigController
{
    /**
     * @var Environment
     */
    protected $environment;

    /**
     * @var RcmErrorHandler2Config
     */
    protected $config;

    /**
     * TestConfigController constructor.
     *
     * @param Environment            $environment
     * @param RcmErrorHandler2Config $config
     */
    public function __construct(
        Environment $environment,
        RcmErrorHandler2Config $config
    ) {
        $this->environment = $environment;
        $this->config = $config;
    }

    /**
     * __invoke
     *
     * @param Request       $request
     * @param Response      $response
     * @param callable|null $next
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, callable $next = null)
    {
        if($this->environment->isProduction()) {
            return $response->withHeader('status', '400');
        }
        $responseData = json_encode($this->config->toArray(), JSON_PRETTY_PRINT);

        $body = $response->getBody();
        $body->write($responseData);

        $response = $response->withHeader('content-type', 'application/json');

        return $response->withBody($body);
    }
}
