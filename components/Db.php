<?php

namespace Component;

use Component\RedbeanDb;
use Component\PdoDb;
/**
 * Класс Db
 * Компонент отвечающий за подключения к БД
 */
class Db
{
    private static $db_config = [];

    public static function init(){

        if (isset(App::$config['db']) && !empty(App::$config['db']['dbtype'])) {
            self::$db_config = App::$config['db'];

            if(self::$db_config['dbtype'] == 'PDO'){
                return PdoDb::connecting(self::$db_config);
            }elseif(self::$db_config['dbtype'] == '\RedBeanPHP\R'){
                return RedbeanDb::connecting(self::$db_config);
            }
        }
    }
}