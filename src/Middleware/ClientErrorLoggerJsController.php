<?php

namespace RcmErrorHandler2\Middleware;

use RcmErrorHandler2\Config\JsLogConfig;
use Zend\Stratigility\Http\Request;
use Zend\Stratigility\Http\Response;

/**
 * Class ClientErrorLoggerJsController
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ClientErrorLoggerJsController
{
    /**
     * @var JsLogConfig
     */
    protected $jsLogConfig;

    /**
     * ClientErrorLoggerJsController constructor.
     *
     * @param JsLogConfig $jsLogConfig
     */
    public function __construct(
        JsLogConfig $jsLogConfig
    ) {
        $this->jsLogConfig = $jsLogConfig;
    }

    /**
     * getOption
     *
     * @param string $key
     * @param null   $default
     *
     * @return null
     */
    protected function getOption($key, $default = null)
    {
        $options = $this->jsLogConfig->get('options', []);

        if (array_key_exists($key, $options)) {
            return $options[$key];
        }

        return $default;
    }

    /**
     * __invoke
     *
     * @param Request       $request
     * @param Response      $response
     * @param callable|null $next
     *
     * @return Response $response
     */
    public function __invoke(Request $request, Response $response, callable $next = null)
    {
        $hasJsLogging = $this->getOption('logJsErrors', false);

        $js = '/* JavaScript logging not enabled */';

        if ($hasJsLogging) {
            $js = file_get_contents(__DIR__ . '/../../public/js-error-logger.js');
        }

        $body = $response->getBody();

        $body->write($js);

        $response = $response->withHeader('content-type', 'application/javascript');

        return $response->withBody($body);
    }
}
