<?php
/**
 * Quantum MVC Micro Framework
 *
 * @package     Model\Controllers\App
 * @author      Corin ALEXANDRU <corin.alex@gmail.com>
 * @copyright   2017 - Corin ALEXANDRU
 * @license     MIT
 *
 */

namespace Model\Controllers\App;

use QuantumMVC\Core\iController;
use QuantumMVC\Core\Display;

final class IndexController implements IController{
    public function IndexAction() {
        Display::render("App/index.html.twig");
    }
}