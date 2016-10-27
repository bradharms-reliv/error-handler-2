<?php

namespace RcmErrorHandler2\ErrorDisplay;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RcmErrorHandler2\Http\ErrorRequest;
use RcmErrorHandler2\Http\ErrorResponse;
use RcmErrorHandler2\Service\ErrorExceptionExtractor;

/**
 * Class ErrorDisplayFinalDoctrineDump
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorDisplayFinalDoctrineDump extends ErrorDisplayFinalAbstract implements ErrorDisplayFinal
{
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
        $response = parent::__invoke($request, $response, $next);
        $body = $response->getBody();

        $errorException = $request->getError();

        $result = ErrorExceptionExtractor::extractArray($errorException);

        ob_start();
        echo $this->errorDisplayConfig->get('finalMessage', '') . "\n\n";
        echo '<pre>';
        \Doctrine\Common\Util\Debug::dump($result, 5);
        echo '</pre>';
        $content = ob_get_contents();
        ob_end_clean();

        $body->write($content);

        return $response->withBody($body);
    }
}
