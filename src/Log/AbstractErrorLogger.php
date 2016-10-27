<?php

namespace RcmErrorHandler2\Log;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;
use RcmErrorHandler2\Service\PhpSession;

/**
 * Class AbstractErrorLogger
 *
 * AbstractErrorLogger
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmErrorHandler\Log
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
abstract class AbstractErrorLogger extends AbstractLogger implements LoggerInterface
{
    /**
     * @var array
     */
    protected $exceptionMethodsBlacklist
        = [
            'getTrace',
            'getPrevious',
            'getTraceAsString',
        ];

    /**
     * @var array
     */
    protected $options = [];

    /**
     * AbstractErrorLogger constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * log
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        // NULL LOGGER - Extend and Over-ride this
    }

    /**
     * getOption
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return null
     */
    protected function getOption($key, $default = null)
    {
        if (isset($this->options[$key])) {
            return $this->options[$key];
        }

        return $default;
    }

    /**
     * getDescription
     *
     * @param array  $extra
     * @param string $lineBreak
     *
     * @return string
     */
    protected function getDescription($extra = [], $lineBreak = "\n")
    {
        $description = '';

        if (isset($extra['description'])) {
            $description .= $extra['description'];
        }

        if (isset($_SERVER) && isset($_SERVER['HTTP_HOST'])) {
            $description .= $lineBreak . ' HOST: ' . $_SERVER['HTTP_HOST'];
        }

        if (isset($_SERVER) && isset($_SERVER['REQUEST_URI'])) {
            $description .= $lineBreak . ' URL: ' . $_SERVER['REQUEST_URI'];
        }

        if (isset($extra['file'])) {
            $description .= $lineBreak . ' File: ' . $extra['file'];
        }

        if (isset($extra['line'])) {
            $description .= $lineBreak . ' Line: ' . $extra['line'];
        }

        if (isset($extra['message'])) {
            $description .= $lineBreak . ' Message: ' . $extra['message'];
        }

        if (isset($extra['trace'])) {
            $description .= $lineBreak . ' Stack trace: ' . $lineBreak
                . $extra['trace'];
        }

        if (isset($extra['exception'])) {
            $description .= $lineBreak
                . $this->prepareException($extra['exception'], $lineBreak);
        }

        $includeServerDump = $this->getOption('includeServerDump', false);

        if (isset($_SERVER) && $includeServerDump) {
            $description .= $lineBreak .
                $this->prepareArray(
                    'Server',
                    $_SERVER,
                    $lineBreak
                );
        }

        $includeSessionVars = $this->getOption('includeSessionVars', null);

        if (isset($_SESSION) && !empty($includeSessionVars)) {
            $description .= $lineBreak .
                $this->prepareSession(
                    $includeSessionVars,
                    $lineBreak
                );
        }

        return $description;
    }

    /**
     * prepareSummary
     *
     * @param $priority
     * @param $message
     *
     * @return string
     */
    protected function prepareSummary($priority, $message)
    {
        $preprocessors = $this->getOption('summaryPreprocessors', []);

        foreach ($preprocessors as $pattern => $replacement) {
            $message = preg_replace($pattern, $replacement, $message);
        }

        $summary = strtoupper($priority) . ': ' . $message;

        $summary = substr($summary, 0, 255);

        $summary = str_replace(
            [
                "\r",
                "\n"
            ],
            ' ',
            $summary
        );

        return $summary;
    }

    /**
     * prepareSession
     *
     * @param mixed  $includeSessionVars
     * @param string $lineBreak
     *
     * @return string
     */
    protected function prepareSession($includeSessionVars, $lineBreak = "\n")
    {
        $sessionVars = [];

        $session = PhpSession::getSessionVars();

        if (is_array($includeSessionVars)) {
            $sessionVarKeys = $includeSessionVars;
            foreach ($sessionVarKeys as $key) {
                if (isset($session[$key])) {
                    $sessionVars[$key] = $session[$key];
                }
            }
        }

        if ($includeSessionVars == 'ALL') {
            $sessionVars = $session;
        }

        return $this->prepareArray('Session', $sessionVars, $lineBreak);
    }

    /**
     * prepareException
     *
     * @param \Throwable|null $exception
     *
     * @return array
     */
    public function prepareException($exception, $lineBreak = "\n")
    {
        if (!$exception instanceof \Throwable && !$exception instanceof \Exception) {
            return json_encode($exception);
        }

        $return = [];
        $return['exception'] = get_class($exception);
        $methods = get_class_methods($exception);
        foreach ($methods as $method) {
            if (substr($method, 0, 3) === "get"
                && !in_array(
                    $method,
                    $this->exceptionMethodsBlacklist
                )
            ) {
                $return[$method] = $exception->$method();
            }
        }

        return $this->prepareArray('Exception', $return, $lineBreak);
    }

    /**
     * prepareArray
     *
     * @todo - Might implement recursive for array
     *
     * @param        $name
     * @param        $array
     * @param string $lineBreak
     *
     * @return string
     */
    protected function prepareArray($name, $array, $lineBreak = "\n")
    {
        $output = $name . ": " . $lineBreak;

        foreach ($array as $key => $val) {
            if (is_string($val)) {
                $output .= ' - ' . $key . ' = "' . $val . '"' . $lineBreak;
            } elseif (is_numeric($val)) {
                $output .= ' - ' . $key . ' = ' . $val . $lineBreak;
            } elseif (is_null($val)) {
                $output .= ' - ' . $key . " = NULL" . $lineBreak;
            } elseif (is_bool($val)) {
                $output
                    .= ' - ' . $key . ' = ' . ($val ? 'TRUE' : 'FALSE') . $lineBreak;
            } else {
                $output .= ' - ' . $key . ' = (' . gettype($val) . ") " . $lineBreak
                    . '{code}' . print_r($val, true) . "{code}" . $lineBreak;
            }
        }

        return $output;
    }
}
