<?php
/**
 * Возвращает массив
 * чей ключ - адрес а
 * значение - путь приложения
 *
 * Пустой ключ - путь по умолчанию, путь если адрес не найден среди ключей
 *
 * 'admin' => 'backend' -
 * https://site.ru/admin => ROOT/admin
 *
 * '' => 'frontend' -
 * https://site.ru/ => ROOT/frontend
 */
return [
    'admin' => 'backend',
    'lk' => 'lkpath',
    '' => 'frontend'
]

?>