<?php

namespace RcmErrorHandler2\Formatter;

use RcmErrorHandler2\Config\Config;
use RcmErrorHandler2\Exception\ErrorException;

/**
 * Class HtmlSummaryFormatter
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class HtmlSummaryFormatter extends AbstractSummaryFormatter implements SummaryFormatter
{
    /**
     * format
     *
     * @param ErrorException $errorException
     *
     * @return string
     */
    public function format(ErrorException $errorException, Config $options)
    {
        $summary = $errorException->getActualExceptionClass() . ' - ' .
            $errorException->getMessage() . ' - ' .
            $this->buildRelativePath($errorException->getFile());

        return $summary;
    }
}
