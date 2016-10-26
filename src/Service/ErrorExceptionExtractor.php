<?php

namespace RcmErrorHandler2\Service;

use RcmErrorHandler2\Exception\ErrorException;

/**
 * Class ErrorExceptionExtractor
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorExceptionExtractor
{
    /**
     * extract
     *
     * @param ErrorException $errorException
     *
     * @return array
     */
    public static function extractArray(ErrorException $errorException)
    {
        $result = [];
        $result['message'] = $errorException->getMessage();
        $result['code'] = $errorException->getCode();
        $result['file'] = $errorException->getFile();
        $result['line'] = $errorException->getLine();
        $result['previous'] = $errorException->getPrevious();
        $result['actualExceptionClass'] = $errorException->getActualExceptionClass();
        $result['handler'] = $errorException->getHandler();
        if ($result['previous'] instanceof \stdClass) {
            $result['previous'] = get_class($result['previous']);
        }
        $result['trace'] = $errorException->getTrace();

        return $result;
    }

    /**
     * extract
     *
     * @param ErrorException $errorException
     *
     * @return array
     */
    public function extract(ErrorException $errorException)
    {
        return self::extractArray($errorException);
    }
}
