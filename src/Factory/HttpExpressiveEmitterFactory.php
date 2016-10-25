<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use Zend\Diactoros\Response\EmitterInterface;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Expressive\Emitter\EmitterStack;

/**
 * Class HttpExpressiveEmitterFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class HttpExpressiveEmitterFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return EmitterInterface
     */
    public function __invoke($container)
    {
        $emitter = new EmitterStack();
        $emitter->push(new SapiEmitter());

        return $emitter;
    }
}
