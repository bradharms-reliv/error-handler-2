<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Formatter\HtmlSummaryFormatter;

/**
 * Class HtmlSummaryFormatterFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class HtmlSummaryFormatterFactory
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
