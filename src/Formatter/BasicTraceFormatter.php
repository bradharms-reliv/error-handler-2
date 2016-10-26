<?php

namespace RcmErrorHandler2\Formatter;

use RcmErrorHandler2\Config\Config;
use RcmErrorHandler2\Exception\ErrorException;

/**
 * Class HtmlTraceFormatter
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class BasicTraceFormatter extends AbstractFormatter implements TraceFormatter
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
        $useFullPath = $options->get('useFullPath', false);

        $actualException = $errorException->getActualException();

        $backtrace = $actualException->getTrace();

        $output = '';

        foreach ($backtrace as $i => $call) {
            if ($i > ($limit - 1) && $limit !== 0) {
                $output .= '.';
                continue;
            }
            $file = (isset($call['file']) ? $this->cleanDirPath($call['file'], $useFullPath)
                : '?');
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
            $output .= '# ' . ($i + 1) . ' ' .
                ': ' . $object . $function . '(' . $argStr . ') ' . "\n" .
                ' -- File: ' . $file . "\n" .
                ' -- Line: ' . $line . "\n";
        }

        return $output;
    }

    /**
     * cleanDirPath
     *
     * @param string $absoluteDir
     * @param bool   $useFullPath
     *
     * @return mixed
     */
    public function cleanDirPath($absoluteDir, $useFullPath)
    {
        if ($useFullPath) {
            return $absoluteDir;
        }
        $relativeDir = $absoluteDir;
        if (empty($this->appDir)) {
            $this->appDir = exec('pwd'); // or getcwd()
        }
        $dirLength = strlen($this->appDir);
        if (substr($absoluteDir, 0, $dirLength) == $this->appDir) {
            $relativeDir = substr_replace($absoluteDir, '', 0, $dirLength);
        }

        return $relativeDir;
    }
}
