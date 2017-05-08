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

namespace QuantumMVC;

use QuantumMVC\Core\Errors;
use QuantumMVC\Core\iController;
use Symfony\Component\Debug\Debug;

use QuantumMVC\Core\Routing;
use QuantumMVC\Core\Display;

define('QUANTUM_START', microtime(true));

// Autoloader
require_once 'Libraries/autoload.php';

// Config File
require_once 'config.php';


class Engine {
    public static function start() {
        if (MAINTENANCE) Errors::maintenance();

        if(DEBUG) {
            Debug::enable();
        }
        else {
            error_reporting(0);
            set_error_handler('QuantumMVC\Core\Errors::basic');
            set_exception_handler('QuantumMVC\Core\Errors::basic');
        }

        $modelName = Routing::getModelName();
        $controllerName = Routing::getControllerName();
        $actionName = Routing::getActionName();

        if (empty($modelName)) {
            $modelName = DEFAULT_MODEL;
            $controllerName = DEFAULT_CONTROLLER;
            $actionName = DEFAULT_ACTION;
        }

        if (empty($controllerName) and $modelName == DEFAULT_MODEL) {
            $controllerName = DEFAULT_CONTROLLER;
        }

        if (file_exists(VIEWS_PATH . $modelName)) {
            $class = "Model\\Controllers\\" . $modelName . "\\" . $controllerName . "Controller";

            if (class_exists($class)) {
                $controller = new $class();

                if (!($controller instanceof iController)) {
                    throw new \Exception("Module invalide");
                }

                if (is_callable( [$controller, $actionName . 'Action'])) {
                    $action = $actionName . 'Action';
                    $controller->$action();
                }
                else {
                    $controller->IndexAction();
                }
            }
            else {
                $viewPath = $modelName . "/" . strtolower($controllerName);
                if (!empty($actionName)) $viewPath .= "." . strtolower($actionName);
                $viewPath .=  ".html.twig";

                if (file_exists( VIEWS_PATH .$viewPath)) {
                    Display::render($viewPath);
                }
            }
        }
        Errors::Show404();
    }
}