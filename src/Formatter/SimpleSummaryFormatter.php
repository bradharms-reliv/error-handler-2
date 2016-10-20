<?php

namespace RcmErrorHandler2\Formatter;

use RcmErrorHandler2\Exception\ErrorException;

/**
 * Class SimpleSummary
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class SimpleSummaryFormatter extends AbstractFormatter implements SummaryFormatter
{
    /**
     * format
     *
     * @param ErrorException $errorException
     *
     * @return string
     */
    public function format(ErrorException $errorException)
    {
        return $errorException->getActualExceptionClass() . ' - ' .
        $errorException->getMessage() . ' - ' .
        $this->buildRelativePath($errorException->getFile());
    }

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
