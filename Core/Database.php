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

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

final class Database
{
    private static $_instance;

    /**
     * Basic Doctrine ORM Initialisation
     *
     * @return EntityManager
     * @throws \Doctrine\ORM\ORMException
     */
    public static function init()
    {
        if (!(self::$_instance instanceof EntityManager))
        {
            $config = Setup::createAnnotationMetadataConfiguration(array(ENTITIES_PATH), false);

            $conn = [
                'driver'   => 'pdo_' . DB_DRIVER,
                'host'     => DB_HOST,
                'dbname'   => DB_NAME,
                'user'     => DB_USER,
                'password' => DB_PWD
            ];

            self::$_instance = EntityManager::create($conn, $config);
        }
        return self::$_instance;
    }


    /**
     * Convert all repository entities into arrays
     *
     * @param array $repository
     * @return array
     */
    public static function convertArray(array $repository) : array {
        $arr = [];
        foreach ($repository as $item) {
            if ($item instanceof iArrayable) {
                $arr[] = $item->toArray();
            }
        }

        return $arr;
    }
}