<?php

namespace RcmErrorHandler2\Formatter;

/**
 * Class AbstractFormatter
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
abstract class AbstractFormatter implements Formatter
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * AbstractFormatter constructor.
     *
     * @param array $options
     */
    public function __construct(
        $options = []
    ) {
        $this->options = $options;
    }

    /**
     * getOption
     *
     * @param string $key
     * @param null   $default
     *
     * @return mixed|null
     */
    public function getOption($key, $default = null)
    {
        if (array_key_exists($key, $this->options)) {
            return $this->options[$key];
        }

        return $default;
    }
}
