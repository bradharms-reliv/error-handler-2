<?php

namespace RcmErrorHandler2\Formatter;

use RcmErrorHandler2\Config\Config;
use RcmErrorHandler2\Exception\ErrorException;

/**
 * Class HtmlFormatter
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class HtmlFormatter extends AbstractFormatter implements Formatter
{
    /**
     * @var TraceFormatter
     */
    protected $defaultTraceFormatter;

    /**
     * SimpleFormatter constructor.
     *
     * @param TraceFormatter $defaultTraceFormatter
     */
    public function __construct(
        TraceFormatter $defaultTraceFormatter
    ) {
        $this->defaultTraceFormatter = $defaultTraceFormatter;
    }

    /**
     * format
     *
     * @param ErrorException $errorException
     * @param Config         $options
     *
     * @return string
     */
    public function format(ErrorException $errorException, Config $options)
    {
        $actualExceptionClass = $errorException->getActualExceptionClass();

        /** @var TraceFormatter $traceFormatter */
        $traceFormatter = $options->get('traceFormatter', $this->defaultTraceFormatter);

        $output
            = '
            <!-- RcmErrorHandler2 -->
            <table class="rcm-error-handler-2 xdebug-error"
                   dir="ltr"
                   border="1"
                   cellspacing="0"
                   cellpadding="1">
                <tbody>
                <tr>
                    <th align="left" bgcolor="#f57900" colspan="5">
                        <div>
                            <span style="background-color: #cc0000; color: #fce94f; font-size: x-large;">( ! )</span>
                            <span>' .
                                $actualExceptionClass . ': ' .
                                $errorException->getMessage() . '
                            </span>
                        </div>
                        <div>File: ' . $errorException->getFile() . '</div>
                        <div>Line: <i>' . $errorException->getLine() . '</i></div>
                        <div>Handler: <i>' . $errorException->getHandler() . '</i></div>
                    </th>
                </tr>
                <tr>
                    <td>
                        ' . $traceFormatter->format($errorException, $options) . '
                    </td>
                </tr>
                </tbody>
            </table>
        ';

        return $output;
    }
}
