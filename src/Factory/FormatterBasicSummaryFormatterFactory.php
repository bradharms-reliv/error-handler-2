<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Formatter\BasicSummaryFormatter;

/**
 * FormatterBasicSummaryFormatterFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class FormatterBasicSummaryFormatterFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return BasicSummaryFormatter
     */
    public function __invoke($container)
    {
        return new BasicSummaryFormatter();
    }
}
