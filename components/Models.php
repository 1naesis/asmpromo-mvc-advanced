<?php

namespace Component;

use Component\Db;

/**
 * This is the model class.
 *
 *
 */
abstract class Models
{
    public array $table = [];

    public function findOne($where = [], $operator = [])
    {
        return Db::findOne($this->getQuery($where, $operator) . ' LIMIT 1', $where);
    }

    public function findAll($where = [], $operator = [])
    {
        return Db::findAll($this->getQuery($where, $operator), $where);
    }

    public function getQuery($where = [], $operator = []): string
    {
        $function = new \ReflectionClass(get_called_class());

        $i = 0;
        $query = 'SELECT * FROM ' . '`' . strtolower($function->getShortName()) . '`';
        if (!empty($where)) {
            foreach ($where as $key => $item) {
                if ($i == 0) {
                    $query .= ' WHERE ';
                } else {
                    $query .= ' AND ';
                }
                $query .= $key . ' ' . $operator[$i] . ' :' . $key;
                $i++;
            }
        }
        return $query;
    }


    public function getInsert($insert = []): string
    {
        $function = new \ReflectionClass(get_called_class());

        if (!empty($insert)) {

            $query = "INSERT INTO " . "`" . strtolower($function->getShortName()) . "` (";
            $fields = "";
            $values = "VALUES (";
            foreach ($insert as $key => $item) {
                $fields .= $key . ",";
                $values .= ':'.$key.",";
            }
            $fields = mb_substr($fields, 0, -1);
            $fields .= ") ";
            $values = mb_substr($values, 0, -1);
            $query .= $fields . $values . ")";
            return $query;
        }
        return false;

    }


    public function insert($insert = [])
    {
        return Db::insert($this->getInsert($insert), $insert);
    }

    public function getUpdate($fields = [], $where = [], $operator = []): string
    {
        $function = new \ReflectionClass(get_called_class());

        if (!empty($fields)) {

            $query = "UPDATE " . "`" . strtolower($function->getShortName()) . "` SET ";

            foreach ($fields as $key => $item) {
                $query .= $key . "=" . ":" . $key . ",";
            }
            $query = mb_substr($query, 0, -1);
            $i = 0;
            foreach ($where as $key => $item) {

                if ($i == 0) {
                    $query .= ' WHERE ';
                } else {
                    $query .= ' AND ';
                }
                $query .= $key . $operator[$i] . ":" . $key ;
                $i++;
            }

            return $query;
        }
        return false;

    }


    public function update($fields = [], $where = [], $operator = [])
    {
        $arr = array_merge($fields,$where);
        return Db::update($this->getUpdate($fields, $where, $operator), $arr);
    }

    public function getDelete($where = [], $operator = []): string
    {
        $function = new \ReflectionClass(get_called_class());

        if (!empty($where)) {
            $query = "DELETE FROM " . "`" . strtolower($function->getShortName()) . "`";
            $i = 0;
            foreach ($where as $key => $item) {
                if ($i == 0) {
                    $query .= ' WHERE ';
                } else {
                    $query .= ' AND ';
                }
                $query .= $key . $operator[$i] . ":" . $key . ",";
                $i++;
            }
            $query = mb_substr($query, 0, -1);
            return $query;
        }
        return false;
    }

    public function delete($where = [], $operator = [])
    {
        return Db::delete($this->getDelete($where, $operator), $where);
    }


}

?>
