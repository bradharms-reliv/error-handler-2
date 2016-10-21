<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Formatter\HtmlFormatter;
use RcmErrorHandler2\Formatter\HtmlTraceFormatter;

/**
 * Class SimpleFormatterFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class HtmlFormatterFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return HtmlFormatter
     */
    public function __invoke($container)
    {
        /** @var HtmlTraceFormatter $htmlTraceFormatter */
        $htmlTraceFormatter = $container->get(HtmlTraceFormatter::class);

        return new HtmlFormatter(
            $htmlTraceFormatter
        );
    }
}
