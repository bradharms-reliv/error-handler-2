<?php

namespace RcmErrorHandler2\Log;

/**
 * Class VarDumpErrorLogger
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmErrorHandler\Log
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class VarDumpErrorLogger extends AbstractErrorLogger
{
    /**
     * Add a message as a log entry
     *
     * @param  int                $priority
     * @param  mixed              $message
     * @param  array|\Traversable $extra
     *
     * @return Logger
     */
    public function log($priority, $message, array $extra = [])
    {
        if (extension_loaded('xdebug')) {
            ini_set('xdebug.var_display_max_depth', 4);
        }
        echo '<pre>';
        var_dump('priority:');
        var_dump($priority);
        var_dump('message:');
        var_dump($message);
        if (isset($extra['trace'])) {
            var_dump('trace:');
            var_dump($extra['trace']);
        }
        if (isset($extra['exception'])) {
            var_dump($this->prepareException($extra['exception']));
        }
        echo '</pre>';

        return $this;
    }
}
