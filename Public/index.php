<?php
/**
 * Quantum MVC Micro Framework
 *
 * @package     QuantumMVC
 * @author      Corin ALEXANDRU <corin.alex@gmail.com>
 * @copyright   2017 - Corin ALEXANDRU
 * @license     MIT
 *
 */

// Checking if the file is included
if(sizeof(get_included_files()) > 1) exit;

// Starting the engine
require_once '../Engine.php';
\QuantumMVC\Engine::start();