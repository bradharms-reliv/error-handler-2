<?php

namespace RcmErrorHandler2\Service;

use RcmErrorHandler2\Exception\ErrorException;
use RcmErrorHandler2\Http\BasicErrorRequest;
use Zend\Diactoros\ServerRequestFactory;

/**
 * Class ErrorServerRequestFactory
 * @todo The should be a service
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ErrorServerRequestFactory extends ServerRequestFactory
{
    /**
     * fromGlobals
     *
     * @param ErrorException $error
     * @param array|null     $server
     * @param array|null     $query
     * @param array|null     $body
     * @param array|null     $cookies
     * @param array|null     $files
     *
     * @return BasicErrorRequest
     */
    public static function errorRequestFromGlobals(
        ErrorException $error,
        array $server = null,
        array $query = null,
        array $body = null,
        array $cookies = null,
        array $files = null
    ) {
        $server = static::normalizeServer($server ?: $_SERVER);
        $files = static::normalizeFiles($files ?: $_FILES);
        // @todo These are not in the formatted as expected
        $headers = static::marshalHeaders($server);

        return new BasicErrorRequest(
            $server,
            $files,
            static::marshalUriFromServer($server, $headers),
            static::get('REQUEST_METHOD', $server, 'GET'),
            'php://input',
            $headers,
            $cookies ?: $_COOKIE,
            $query ?: $_GET,
            $body ?: $_POST,
            static::getMarshalProtocolVersion($server),
            $error
        );
    }

    /**
     * Return HTTP protocol version (X.Y)
     *
     *
     * @param array $server
     * @return string
     */
    public static function getMarshalProtocolVersion(array $server)
    {
        if (! isset($server['SERVER_PROTOCOL'])) {
            return '1.1';
        }

        if (! preg_match('#^(HTTP/)?(?P<version>[1-9]\d*(?:\.\d)?)$#', $server['SERVER_PROTOCOL'], $matches)) {
            throw new \UnexpectedValueException(sprintf(
                'Unrecognized protocol version (%s)',
                $server['SERVER_PROTOCOL']
            ));
        }

        return $matches['version'];
    }
}
