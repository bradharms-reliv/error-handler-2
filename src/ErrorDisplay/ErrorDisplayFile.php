<?php

namespace RcmErrorHandler2\ErrorDisplay;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RcmErrorHandler2\Config\Config;
use RcmErrorHandler2\Config\ErrorDisplayFileConfig;
use RcmErrorHandler2\Http\ErrorRequest;
use RcmErrorHandler2\Http\ErrorResponse;
use RcmErrorHandler2\Service\ErrorExceptionBuilder;

/**
 * Class ErrorDisplayFile
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayFile extends ErrorDisplayAbstract implements ErrorDisplay
{
    /**
     * @var Config
     */
    protected $formatterConfig;

    /**
     * ErrorDisplayFile constructor.
     *
     * @param ErrorDisplayFileConfig $formatterConfig
     */
    public function __construct(
        ErrorDisplayFileConfig $formatterConfig
    ) {
        $this->formatterConfig = $formatterConfig;
    }

    /**
     * __invoke
     *
     * @param ErrorRequest  $request
     * @param ErrorResponse $response
     * @param callable|null $next
     *
     * @return callable|ErrorResponse
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, $next = null)
    {
        $errorException = $request->getError();

        $code = $errorException->getCode();

        $fileContents = $this->getFileContents($code);

        if (empty($fileContents)) {
            return $next($request, $response);
        }

        $response = $response->withNormalErrorHandling(false);

        $body = $response->getBody();

        $body->write($fileContents);

        return $response->withBody($body);
    }

    /**
     * getFileContents
     *
     * @param $code
     *
     * @return null|string
     */
    protected function getFileContents($code)
    {
        $filePath = $this->getFilePath($code);

        if (empty($filePath)) {
            return null;
        }

        return file_get_contents($filePath);
    }

    /**
     * getFilePath
     *
     * @param int|mixed $code
     *
     * @return string|null
     */
    protected function getFilePath($code)
    {
        ErrorExceptionBuilder::buildDefaultCode($code);

        $code = (string)$code;

        $file = null;

        $path = $this->formatterConfig->get(
            'httpStatusFileDirectory',
            ''
        );

        if (empty($path)) {
            return null;
        }

        $fileName = $code . '.html';

        $filePath = $path . '/' . $fileName;

        if (file_exists($filePath)) {
            return $filePath;
        }

        $length = strlen($code);

        if (!$length === 3) {
            return null;
        }

        $first = substr($code, 0, 1);

        $fileName = $first . '0x.html';

        $filePath = $path . '/' . $fileName;

        if (file_exists($filePath)) {
            return $filePath;
        }

        return null;
    }
}
