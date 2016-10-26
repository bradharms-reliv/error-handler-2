<?php

namespace RcmErrorHandler2\Factory;

use Interop\Container\ContainerInterface;
use RcmErrorHandler2\Formatter\BasicTraceFormatter;

/**
 * FormatterBasicTraceFormatterFactory
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class FormatterBasicTraceFormatterFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface $container
     *
     * @return BasicTraceFormatter
     */
    public function __invoke($container)
    {
        return new BasicTraceFormatter();
    }
}
