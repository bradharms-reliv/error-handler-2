<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Formatter\HtmlTraceFormatter;

/**
 * FormatterHtmlTraceFormatterFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class FormatterHtmlTraceFormatterFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return HtmlTraceFormatter
     */
    public function __invoke($container)
    {
        return new HtmlTraceFormatter();
    }
}
