<?php

namespace RcmErrorHandler2\Test;

use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use RcmErrorHandler2\Config\RcmErrorHandler2Config;
use RcmErrorHandler2\Log\AbstractErrorLogger;
use RcmErrorHandler2\Middleware\ClientErrorLoggerController;
use Zend\Stratigility\Http\Request;
use Zend\Stratigility\Http\Response;
use Psr\Log\LoggerInterface;

class ClientErrorLoggerControllerTest extends TestCase
{
    const MockLoggerContainerKey = 'MockLogger';

    public function testInvokeSuccessfullyLogsWithValidUserAgent()
    {
        $config = new RcmErrorHandler2Config([
            'jsLogConfig' => [
                'options' => [
                    'logJsErrors' => true,
                    'routeWhiteList' => [],
                    'userAgentBlackList' => [
                        '/.*BADUSERAGENT.*/i',
                    ]
                ],
                /**
                 * Define which loggers to use for JS logging
                 */
                'jsLoggers' => [
                    self::MockLoggerContainerKey,
                ],
            ]
        ]);

        $mockLogger = $this->getMockBuilder(AbstractErrorLogger::class)
            ->disableOriginalConstructor()
            ->setMethods(['error'])
            ->getMock();
        $mockLogger->expects($this->once())
            ->method('error')
            ->with($this->equalTo('ClientError - some message - /some/url'));

        $container = $this->getMockBuilder(ContainerInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(['get'])
            ->getMock();
        $container->expects($this->any())
            ->method('get')
            ->will($this->returnValueMap([
                [RcmErrorHandler2Config::class, $config],
                [self::MockLoggerContainerKey, $mockLogger]
            ]));

        $unit = new ClientErrorLoggerController($container);

        $request = $container = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->setMethods(['getParsedBody', 'getHeaderLine'])
            ->getMock();
        $request->expects($this->any())
            ->method('getParsedBody')
            ->willReturn([
                'message' => 'some message',
                'file' => '/some/url',
                'line' => 123,
                'description' => 'Some Description',
                'trace' => '1# Some trace string',
                'type' => 'ClientError',
            ]);
        $request->expects($this->any())
            ->method('getHeaderLine')
            ->willReturn('hmm GOODUSERAGENT yea one');

        $response = $container = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->setMethods([])
            ->getMock();

        $unit->__invoke($request, $response);
    }

    public function testInvokeDoesNotLogWithInvalidUserAgent()
    {
        $config = new RcmErrorHandler2Config([
            'jsLogConfig' => [
                'options' => [
                    'logJsErrors' => true,
                    'routeWhiteList' => [],
                    'userAgentBlackList' => [
                        '/.*BADUSERAGENT.*/i',
                    ]
                ],
                /**
                 * Define which loggers to use for JS logging
                 */
                'jsLoggers' => [
                    self::MockLoggerContainerKey,
                ],
            ]
        ]);

        $mockLogger = $this->getMockBuilder(AbstractErrorLogger::class)
            ->disableOriginalConstructor()
            ->setMethods(['error'])
            ->getMock();
        $mockLogger->expects($this->never())
            ->method('error');

        $container = $this->getMockBuilder(ContainerInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(['get'])
            ->getMock();
        $container->expects($this->any())
            ->method('get')
            ->will($this->returnValueMap([
                [RcmErrorHandler2Config::class, $config],
                [self::MockLoggerContainerKey, $mockLogger]
            ]));

        $unit = new ClientErrorLoggerController($container);

        $request = $container = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->setMethods(['getParsedBody', 'getHeaderLine'])
            ->getMock();
        $request->expects($this->any())
            ->method('getParsedBody')
            ->willReturn([
                'message' => 'some message',
                'file' => '/some/url',
                'line' => 123,
                'description' => 'Some Description',
                'trace' => '1# Some trace string',
                'type' => 'ClientError',
            ]);
        $request->expects($this->any())
            ->method('getHeaderLine')
            ->willReturn('hmm BaDUSERAGENT yea one');

        $response = $container = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->setMethods([])
            ->getMock();

        $unit->__invoke($request, $response);
    }
}
