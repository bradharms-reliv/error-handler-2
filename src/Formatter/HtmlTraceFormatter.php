<?php

namespace RcmErrorHandler2\Formatter;

use RcmErrorHandler2\Core\Config;
use RcmErrorHandler2\Exception\ErrorException;

/**
 * Class HtmlTraceFormatter
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class HtmlTraceFormatter extends AbstractFormatter implements TraceFormatter
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
        $limit = $options->get('traceLimit', 0);

        $actualException = $errorException->getActualException();

        $backtrace = $actualException->getTrace();

        $ret = [];

        $output
            = '
            <table dir="ltr"
                   border="1"
                   cellspacing="0"
                   cellpadding="1">
                <tr>
                    <th align="left" bgcolor="#e9b96e" colspan="5">Call Stack</th>
                </tr>
                <tr>
                    <th align="center" bgcolor="#eeeeec">#</th>
                    <th align="left" bgcolor="#eeeeec">Function</th>
                    <th align="left" bgcolor="#eeeeec">Location</th>
                </tr>
        ';

        foreach ($backtrace as $i => $call) {
            if ($i > ($limit - 1) && $limit !== 0) {
                $output .= '.';
                continue;
            }

            $file = (isset($call['file']) ? $call['file'] : '?');
            $line = (isset($call['line']) ? $call['line'] : '?');
            $class = (isset($call['class']) ? $call['class'] : '');
            $function = (isset($call['function']) ? $call['function'] : '');
            $type = (isset($call['type']) ? $call['type'] : '');

            $args = (isset($call['args']) ? (array)$call['args'] : []);

            $object = '';
            if (!empty($class)) {
                $object = $class . $type;
            }

            foreach ($args as $key => $arg) {
                if (is_object($arg)) {
                    $args[$key] = get_class($arg);
                } else {
                    if (is_array($arg)) {
                        $args[$key] = 'array';
                    } else {
                        $args[$key] = (string)$arg;
                    }
                }
            }

            $argStr = implode(', ', $args);

            $output
                .= '
                    <tr>
                        <td bgcolor="#eeeeec" align="center">' . $i . '</td>
                        <td bgcolor="#eeeeec">' .
                $object . $function . '(' . $argStr . ')' . '
                        </td>
                        <td title="' . $file . '" bgcolor="#eeeeec">' .
                $file . '<b>:</b>' . $line . '
                        </td>
                    </tr>
                ';
        }

        $output
            .= '
                    </tbody>
                </table>
            ';

        return $output;
    }
}
