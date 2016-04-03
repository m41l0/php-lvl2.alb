<?php

// Подключение к БД
function sqlConnect()
{
// Настройка подключения к БД
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'lmi_db';

// Подключение к серверу
    $connect = mysqli_connect($hostname, $username, $password) or die(mysqli_error($connect));
    mysqli_query($connect, 'SET NAMES utf8');
    mysqli_select_db($connect, $dbName) or die(mysqli_error($connect));
    return $connect;
}

// Просто выполнение запроса без возврата
function sqlExec($sql)
{
    $connect = sqlConnect();

    if (!mysqli_query($connect, $sql))
        die(mysqli_error($connect));    
    
    mysqli_close($connect);
}

// Выполнение запроса к БД с возвратом в двумерный массив
function sqlQuery($sql)
{
    $connect = sqlConnect();
    $result = mysqli_query($connect, $sql);

    if (!$result)
        die(mysqli_error($connect));

    // Извлечение из БД
    $ret = [];
    while (false != $row = mysqli_fetch_assoc($result)) {
        $ret[] = $row;
    }

    mysqli_close($connect);
    return $ret; // двумерный массив
}

// Выполнение запроса к БД с возвратом в одномерный массив
function sqlQueryDimensional($sql)
{
    $connect = sqlConnect();
    $result = mysqli_query($connect, $sql);

    if (!$result)
        die(mysqli_error($connect));

    // Извлечение из БД
    while (false != $row = mysqli_fetch_assoc($result)) {
        $ret = $row;
    }

    mysqli_close($connect);
    return $ret; // одномерный массив
}