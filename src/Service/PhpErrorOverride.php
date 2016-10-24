<?php

namespace RcmErrorHandler2\Service;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Config\RcmErrorHandler2Config;
use RcmErrorHandler2\Handler\Error;
use RcmErrorHandler2\Handler\Throwable;

/**
 * Class PhpErrorOverride
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class PhpErrorOverride
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var RcmErrorHandler2Config
     */
    protected $rcmErrorHandler2Config;

    /**
     * PhpErrorOverride constructor.
     *
     * @param ContainerInterface     $container
     * @param RcmErrorHandler2Config $rcmErrorHandler2Config
     */
    public function __construct(
        $container,
        RcmErrorHandler2Config $rcmErrorHandler2Config
    ) {
        $this->container = $container;
        $this->rcmErrorHandler2Config = $rcmErrorHandler2Config;
    }

    /**
     * override
     *
     * @return void
     */
    public function override()
    {
        if ($this->rcmErrorHandler2Config->get('overrideErrors', false)) {
            PhpErrorHandlerManager::setErrorHandler(
                $this->container->get(Error::class)
            );
        }

        if ($this->rcmErrorHandler2Config->get('overrideExceptions', false)) {
            PhpErrorHandlerManager::setExceptionHandler(
                $this->container->get(Throwable::class)
            );
        }
    }
}
