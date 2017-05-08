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

final class Errors
{
    /**
     * Basic page for all errors, no debug
     */
    public static function basic()
    {
        header("Content-Type: text/html; charset=utf-8");
        http_response_code(500);
        echo file_get_contents(ERROR_PAGES . 'Basic.html');
        exit();
    }

    /**
     * Show a custom 404 page
     */
    public static function Show404()
    {
        header("HTTP/1.1 404 Not Found");
        header("Content-Type: text/html; charset=utf-8");
        echo file_get_contents(ERROR_PAGES . '404.html');
        exit();
    }


    /**
     * When under maintenance
     */
    public static function maintenance()
    {
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        error_reporting(0);

        http_response_code(503);
        header("Content-Type: text/html; charset=utf-8");
        echo file_get_contents(ERROR_PAGES . 'Maintenance.html');
        exit();
    }
}