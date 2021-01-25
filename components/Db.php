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

    public function init(){

        if (isset(App::$config['db']) && !empty(App::$config['db']['dbtype'])) {
            self::$db_config = App::$config['db'];

            if(self::$db_config['dbtype'] == 'PDO'){
                return PdoDb::connecting();
            }elseif(self::$db_config['dbtype'] == '\RedBeanPHP\R'){
                return RedbeanDb::connecting();
            }
        }
    }
}