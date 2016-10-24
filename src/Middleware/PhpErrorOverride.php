<?php

namespace RcmErrorHandler2\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PhpErrorOverride
{
    /**
     * @var \RcmErrorHandler2\Service\PhpErrorOverride
     */
    protected $phpErrorOverrideService;

    /**
     * PhpErrorOverride constructor.
     *
     * @param \RcmErrorHandler2\Service\PhpErrorOverride $phpErrorOverrideService
     */
    public function __construct(
        \RcmErrorHandler2\Service\PhpErrorOverride $phpErrorOverrideService
    ) {
        $this->phpErrorOverrideService = $phpErrorOverrideService;
    }

    /**
     * __invoke
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable               $next
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $this->phpErrorOverrideService->override();

        return $next($request, $response);
    }
}
