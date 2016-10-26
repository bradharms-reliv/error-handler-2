<?php

namespace RcmErrorHandler2\Middleware;

use Interop\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use RcmErrorHandler2\Config\RcmErrorHandler2Config;
use Zend\Stratigility\Http\Request;
use Zend\Stratigility\Http\Response;

/**
 * Class ClientErrorLoggerController
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ClientErrorLoggerController
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * ClientErrorLoggerController constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * __invoke
     *
     * @request
     * {
     * "message": "some message",
     * "file": "/some/url",
     * "line": 123,
     * "description": "Some Description",
     * "trace": "1# Some trace string",
     * "type": "ClientError"
     * }
     *
     * @param Request       $request
     * @param Response      $response
     * @param callable|null $next
     *
     * @return mixed
     */
    public function __invoke(Request $request, Response $response, callable $next = null)
    {
        $data = $request->getParsedBody();

        $hasLogged = false;
        if ($this->isValidRoute($data) && $this->canLogErrors()) {
            $hasLogged = $this->doLog($this->prepareMessage($data), $data);
        }

        $responseData = json_encode(["success" => $hasLogged]);

        $body = $response->getBody();
        $body->write($responseData);

        $response = $response->withHeader('content-type', 'application/json');

        return $response->withBody($body);
    }

    /**
     * getContainer
     *
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->container;
    }

    /**
     * getLoggerConfig
     *
     * @return array
     */
    protected function getLoggerConfig()
    {
        $serviceLocator = $this->getContainer();
        $rcmErrorHandler2Config = $serviceLocator->get(RcmErrorHandler2Config::class);

        $configs = $rcmErrorHandler2Config->get('jsLogConfig', []);

        return $configs;
    }

    /**
     * doLog
     *
     * @param string $message
     * @param array  $extra
     *
     * @return bool
     */
    protected function doLog($message, $extra = [])
    {
        $loggerConfig = $this->getLoggerConfig();
        $serviceLocator = $this->getContainer();

        $hasLogged = false;

        foreach ($loggerConfig['jsLoggers'] as $serviceName) {
            /** @var LoggerInterface $logger */
            $logger = $serviceLocator->get($serviceName);
            $logger->error($message, $extra);
            $hasLogged = true;
        }

        return $hasLogged;
    }

    /**
     * getDataValue
     *
     * @param array  $data
     * @param string $key
     * @param null   $default
     *
     * @return null
     */
    protected function getDataValue($data, $key, $default = null)
    {
        if (isset($data[$key])) {
            return $data[$key];
        }

        return $default;
    }

    /**
     * prepareMessage
     *
     * @param array $data
     *
     * @return string
     */
    protected function prepareMessage($data)
    {
        $message = $this->getDataValue($data, 'type', 'ClientError') . ' - ' .
            $this->getDataValue($data, 'message', '(no message)') . ' - ' .
            $this->getDataValue($data, 'file', 'UNKNOWN FILE');

        return $message;
    }

    /**
     * isValidRoute
     *
     * @param mixed $data
     *
     *  $data = [
     *   'message' => 'some message',
     *   'file' => '/some/url',
     *   'line' => 123,
     *   'description' => 'Some Description',
     *   'trace' => '1# Some trace string'
     *   'type' => 'ClientError'
     *  ];
     *
     * @return boolean
     */
    protected function isValidRoute($data)
    {
        $routeUrl = $this->getDataValue($data, 'file');

        $loggerConfig = $this->getLoggerConfig();

        $validRoutes = $loggerConfig['options']['validRoutes'];

        if (empty($validRoutes)) {
            // default is all
            return true;
        }

        foreach ($validRoutes as $routes) {
            /* add routes to match in config using regex  */
            if (preg_match($routes, $routeUrl) != 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * canLogErrors
     *
     * @return boolean
     */
    protected function canLogErrors()
    {
        $loggerConfig = $this->getLoggerConfig();

        return $loggerConfig['options']['logJsErrors'];
    }
}
