<?php

namespace RcmErrorHandler2\Formatter;

use RcmErrorHandler2\Exception\ErrorException;

/**
 * Class SimpleFormatter
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class SimpleFormatter extends AbstractFormatter implements Formatter
{
    /**
     * @var TraceFormatter
     */
    protected $traceFormatter;

    /**
     * SimpleFormatter constructor.
     *
     * @param array          $options
     * @param TraceFormatter $traceFormatter
     */
    public function __construct(
        array $options,
        TraceFormatter $traceFormatter
    ) {
        $this->traceFormatter = $traceFormatter;
        parent::__construct($options);
    }

    /**
     * format
     *
     * @param ErrorException $errorException
     *
     * @return string
     */
    public function format(ErrorException $errorException)
    {
        $actualExceptionClass = $errorException->getActualExceptionClass();

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
                    </th>
                </tr>
                <tr>
                    <td>
                        ' . $this->traceFormatter->format($errorException) . '
                    </td>
                </tr>
                </tbody>
            </table>
        ';

        return $output;
    }
}
