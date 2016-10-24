<?php

namespace RcmErrorHandler2\Formatter;

use RcmErrorHandler2\Config\Config;

/**
 * Class AbstractSummaryFormatter
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
abstract class AbstractSummaryFormatter extends AbstractFormatter implements SummaryFormatter
{
    /**
     * buildRelativePath
     *
     * @param $absoluteDir
     *
     * @return mixed
     */
    protected function buildRelativePath($absoluteDir)
    {
        $relativeDir = $absoluteDir;

        $appDir = exec('pwd'); // or getcwd() could work if no symlinks are used

        $dirLength = strlen($appDir);

        if (substr($absoluteDir, 0, $dirLength) == $appDir) {
            $relativeDir = substr_replace($absoluteDir, '', 0, $dirLength);
        }

        return $relativeDir;
    }
}
