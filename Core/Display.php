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

final class Display
{
    public static function render($file, $vars = array())
    {
        $loader = new \Twig_Loader_Filesystem(VIEWS_PATH);
		$twig = new \Twig_Environment($loader, array('cache' => CACHE_PATH, 'debug' => DEBUG));

		echo $twig->render($file, $vars);
        exit;
    }
}