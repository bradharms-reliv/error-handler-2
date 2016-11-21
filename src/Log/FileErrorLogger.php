<?php

namespace RcmErrorHandler2\Log;

/**
 * Class FileErrorLogger
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmErrorHandler2\Log
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class FileErrorLogger extends AbstractErrorLogger
{
    /**
     * Add a message as a log entry
     *
     * @param  int                $priority
     * @param  mixed              $message
     * @param  array|\Traversable $extra
     *
     * @return void
     */
    public function log($priority, $message, array $extra = [])
    {
        if (extension_loaded('xdebug')) {
            ini_set('xdebug.var_display_max_depth', 4);
        }
        $now = new \DateTime('now', new \DateTimeZone('UTC'));
        $array = [];

        $array['summary:'] = $this->prepareSummary($priority, $message);
        $array['priority:'] = $priority;

        $array['time:'] = $now->format('Y-m-d-H:m:s');
        $array['message:'] = $message;
        if (isset($extra['trace'])) {
            $array['trace:'] = $extra['trace'];
        }

        if (isset($extra['traceArray'])) {
            $array['traceArray:'] = $extra['traceArray'];
        }

        if (isset($extra['exception'])) {
            $array['exception:'] = $this->prepareException($extra['exception']);
        }

        if (isset($extra['handler'])) {
            $array['handler:'] = $extra['handler'];
        }

        $contents = json_encode($array, JSON_PRETTY_PRINT);

        $fileLogPath = $this->getOption(
            'fileLogPath',
            '/var/log'
        );

        $fileName = $this->getOption(
            'fileName',
            'rcm-error-handler-2-log'
        );

        if (!file_exists($fileLogPath)) {
            mkdir($fileLogPath, 0766, true);
        }

        $fileLogPath = realpath($fileLogPath);

        $fileName = $fileName . '-' . $now->format('Y-m-d') . '.json';

        $fileLogPathFile = $fileLogPath . '/' . $fileName;

        file_put_contents($fileLogPathFile, $contents . ",\n", FILE_APPEND);
    }
}
