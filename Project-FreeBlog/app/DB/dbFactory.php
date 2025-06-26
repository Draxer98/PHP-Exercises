<?php

namespace app\DB;
use app\DB\DBPDO;

class dbFactory
{
    public static function create(array $options)
    {
        if (array_key_exists('dsn', $options)) {
            if (!array_key_exists('drivers', $options)) {
                throw new \InvalidArgumentException('No default drivers');
            }
            $dsn = '';
            switch ($options['drivers']) {

                case 'mysql':
                case 'oracle':
                case 'mssql':
                    $dsn = $options['drivers'] . ':host=' . $options['host'];
                    $dsn .= ';dbname=' . $options['database'] . ';charset=utf8';
                    break;
                case 'sqlite':
                    $dsn = 'sqllite:' . $options['database'];
                    break;
                default:
                    throw new \InvalidArgumentException('Drivers not set or known');
            }
            $options['dsn'] = $dsn;
        }
        return DBPDO::getInstance($options);
    }
}
