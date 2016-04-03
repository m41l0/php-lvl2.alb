<?php

// Подключение функций для работы с MySQL
require_once __DIR__ . '/../components/sql.php';

// Получение всех статей
function articles_all()
{
    $sql = "SELECT * FROM `articles` ORDER BY `date` DESC";
    return sqlQuery($sql);
}

// Получение статей по id
function articles_get($id)
{
    $sql = "SELECT * FROM `articles` WHERE `id_article` = '".$id."'";
    return sqlQueryDimensional($sql);
}

// Добавить статью
function article_new($title, $content)
{
    // Подготовка
    $title = trim($title);
    $content = trim($content);

    // Проверка
    if ($title == '')
        return false;

    // Запрос
    $sql = "
        INSERT INTO `articles`
        (`title`, `content`)
        VALUES
        ('".$title."', '".$content."')
        ";

    sqlExec($sql);

    return true;
}

function article_edit($id, $title, $content)
{
    // Подготовка
    $id = (int)$id;
    $title = trim($title);
    $content = trim($content);

    // Проверка
    if ($title == '')
        return false;

    // Запрос
    $sql = "UPDATE `articles` SET `title`='".$title."', `content`='".$content."' WHERE `id_article`='".$id."'";
    sqlExec($sql);
}

function article_delete($id)
{
    $sql = "DELETE FROM `articles` WHERE `id_article` = '".$id."'";
    sqlExec($sql);
}

// Интро статьи
function article_intro($content, $max_words)
{
    $words = explode(' ', $content);

    if (count($words) > $max_words && $max_words > 0) {
        $content = implode(' ', array_slice($words, 0, $max_words)) . '...';
    }

    return $content;
}

function counter($id)
{
    $sql = "UPDATE `articles` SET `views`=`views`+1 WHERE `id_article`='".$id."'";
    sqlExec($sql);
}

//
// Генерация шаблона
//
function template($file, $vars = array())
{
    // Установка переменных для шаблона
    foreach ($vars as $k => $v) {
        $$k = $v;
    }

    // Генерация HTML в строку
    ob_start();
    include $file;
    return ob_get_clean();
}