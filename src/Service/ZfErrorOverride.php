<?php

namespace RcmErrorHandler2\Service;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Core\RcmErrorHandler2Config;
use RcmErrorHandler2\Handler\BasicZfThrowable;
use RcmErrorHandler2\Handler\Error;
use RcmErrorHandler2\Handler\Throwable;
use RcmErrorHandler2\Handler\ZfThrowable;
use Zend\Mvc\MvcEvent;

/**
 * Class PhpErrorOverride
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ZfErrorOverride
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
     * ZfErrorOverride constructor.
     *
     * @param ContainerInterface     $container
     * @param RcmErrorHandler2Config $rcmErrorHandler2Config
     * @param MvcEvent               $event
     */
    public function __construct(
        $container,
        RcmErrorHandler2Config $rcmErrorHandler2Config,
        MvcEvent $event
    ) {
        $this->rcmErrorHandler2Config = $rcmErrorHandler2Config;
        $this->event = $event;
    }

    /**
     * override
     *
     * @return void
     */
    public function override()
    {
        if ($this->rcmErrorHandler2Config->get('overrideExceptions', false)) {

            $application = $this->event->getApplication();
            $eventManager = $application->getEventManager();

            /** @var BasicZfThrowable $handler */
            $handler = $this->container->get(ZfThrowable::class);

            //handle the dispatch error (exception)
            $eventManager->attach(
                \Zend\Mvc\MvcEvent::EVENT_DISPATCH_ERROR,
                [
                    $handler,
                    'handleEvent'
                ]
            );

            //handle the view render error (exception)
            $eventManager->attach(
                \Zend\Mvc\MvcEvent::EVENT_RENDER_ERROR,
                [
                    $handler,
                    'handleEvent'
                ]
            );
        }
    }
}
