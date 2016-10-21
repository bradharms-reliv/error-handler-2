<?php

namespace RcmErrorHandler2\Log;

/**
 * Class PhpErrorLogger
 *
 * PhpErrorLogger Logger
 * @todo Allow destination, and extra_headers as config options
 * @todo Create factory to inject options
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmErrorHandler\Log
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright ${YEAR} Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class PhpErrorLogger extends AbstractErrorLogger
{
    /**
     * Add a message as a log entry
     *
     * @param  int               $priority
     * @param  mixed             $message
     * @param  array|\Traversable $extra
     *
     * @return void
     */
    public function log($priority, $message, array $extra = [])
    {
        $messageType = $this->getOption('error_log_message_type', null);

        error_log(
            'PhpErrorLogger: ' . $priority . ': ' . $message,
            $messageType
        );
    }
}
