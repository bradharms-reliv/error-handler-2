<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Formatter\HtmlSummaryFormatter;

/**
 * Class FormatterHtmlSummaryFormatterFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class FormatterHtmlSummaryFormatterFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return HtmlSummaryFormatter
     */
    public function __invoke($container)
    {
        return new HtmlSummaryFormatter();
    }
}
