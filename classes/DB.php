<?php

/**
 * Класс для подключения к БД и работы с ней
 */
class DB extends mysqli
{
    public function __construct()
    {
        // Настройка подключения к БД
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $dbName = 'lmi_db';

        // Подключение к серверу
        parent::__construct($hostname, $username, $password, $dbName);
        mysqli:$this->query('SET NAMES utf8');

        // TODO Добавить проверку
    }

    public function queryAll($sql, $class = 'stdClass')
    {
        if ($res = mysqli::query($sql)) {
            $ret = [];
            while ($obj = $res->fetch_object($class)) {
                $ret[] = $obj;
            }
            // TODO Закрыть подключение к БД ??
            return $ret;
        }
    }

    public function queryOne($sql, $class = 'stdClass')
    {
        return $this->queryAll($sql, $class)[0];
    }
}