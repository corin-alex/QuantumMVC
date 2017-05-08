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

use Symfony\Component\HttpFoundation\Request;

class Routing
{
    /**
     * Gets module name from QueryString
     * @return string
     */
    public static function getModelName() : string
    {

        $request =  Request::createFromGlobals();
        $route = explode("/", urldecode($request->getQueryString()));
        return (!empty($route[0])) ? ucfirst(strtolower(self::sanitizeVar($route[0], 'alnum'))) : "";
    }

    /**
     * Gets controller name from QueryString
     * @return string
     */
    public static function getControllerName() : string
    {

        $request =  Request::createFromGlobals();
        $route = explode("/", urldecode($request->getQueryString()));
        return (!empty($route[1])) ? ucfirst(strtolower(self::sanitizeVar($route[1], 'alnum'))) : "";
    }

    /**
     * Gets action name from QueryString
     * @return string
     */
    public static function getActionName() : string
    {
        $request =  Request::createFromGlobals();
        $route = explode("/", urldecode($request->getQueryString()));
        return (!empty($route[2])) ? self::sanitizeVar($route[2], 'alnum') : "";
    }

    /**
     * Checks if a route is valid
     *
     * @param string $route
     * @return bool
     */
    public static function validateRoute(string $route) : bool
    {
        return (!empty($route) and ctype_alnum($route) and self::moduleExists($route));
    }

    /**
     * Checks if a module exists
     *
     * @param string $name
     * @return bool
     */
    public static function moduleExists(string $name) : bool
    {
        return true;
    }

    /**
     * Sanitize a variable
     *
     * @param $var
     * @param string $type
     * @return bool|float|null
     * @throws \Exception
     */
    public static function sanitizeVar($var, string $type)
    {
        if (!is_scalar($var)) return null;
        if(!empty($var))
        {
            switch ($type)
            {
                case 'string' :
                    return (string) filter_var($var, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                    break;
                case 'alnum' :
                    return (string) preg_replace( '/\W+/', '', $var);
                    break;
                case 'file' :
                    return (string) preg_replace( '/[^a-zA-Z0-9\_\.\-]/', '', $var);
                    break;
                case 'int' :
                    return (int) filter_var($var, FILTER_SANITIZE_NUMBER_INT);
                    break;
                case 'float' :
                    return (float) filter_var($var, FILTER_SANITIZE_NUMBER_FLOAT);
                    break;
                case 'numeric' :
                    return (is_numeric($var)) ? $var : filter_var($var, FILTER_SANITIZE_NUMBER_INT);
                    break;
                case 'email' :
                    return (string) filter_var($var, FILTER_SANITIZE_EMAIL);
                    break;
                case 'url' :
                    return (string) Tools::fullUrlEncode(filter_var($var, FILTER_SANITIZE_URL));
                    break;
                case 'bool' :
                    return (bool) (!empty($var) and ($var != false or $var > 0)) ? true : false;
                    break;
                case 'raw' :
                    return $var;
                    break;
                default :
                    throw new \Exception('Type de variable invalide "' . $type . '", request::vars()');
            }
        }
        else
        {
            switch ($type)
            {
                case 'string' :
                case 'email' :
                case 'album' :
                case 'url' :
                    return (string) '';
                    break;
                case 'int' :
                case 'numeric' :
                    return (int) 0;
                    break;
                case 'float' :
                    return (float) 0;
                    break;
                case 'bool' :
                    return (bool) false;
                    break;
                default :
                    return NULL;
            }
        }
    }
}