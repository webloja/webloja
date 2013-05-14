<?php
namespace webloja\LIB;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Configuration;

class DBALConnection {

    public static function getDBALConection() {

        $config = new Configuration();
        $connectionParams = array(
            'dbname' => 'lasasap',
            'user' => 'fmello',
            'password' => 'fmello',
            'host' => '52.31.153.101',
            'port' => '3308',
            'driver' => 'pdo_mysql',
            'charset' => 'utf8'
        );
        $conn = DriverManager::getConnection($connectionParams, $config);
        return $conn;
    }

}

