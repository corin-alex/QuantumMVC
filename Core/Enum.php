<?php
/**
 * Quantum MVC Micro Framework
 *
 * @package     QuantumMVC\Core
 * @author      Corin ALEXANDRU <corin.alex@gmail.com>
 * @copyright   2017 - Corin ALEXANDRU
 * @license     MIT
 *
 */

namespace QuantumMVC\Core;

/**
 * Basic Enum object
 */
class Enum
{
    /**
     * Enum constructor.
     * @param array $properties
     */
    public function __construct($properties = array())
    {
        foreach ($properties as $key => $val)
        {
            $this->{$key} = $val;
        }
    }
}