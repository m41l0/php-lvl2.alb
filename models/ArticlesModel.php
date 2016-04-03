<?php

require_once __DIR__ . '/../classes/DB.php';

class Articles
{
    public $id_article;
    public $title;
    public $content;
    public $date;
    public $views;

    // Получение всех статей
    public static function getAll()
    {
        $db = new DB;
        $sql = "SELECT * FROM `articles` ORDER BY `date` DESC";
        return $db->queryAll($sql, 'Articles');
    }

    // Получение статей по id
    public static function getOne($id)
    {
        $db = new DB;
        $sql = "SELECT * FROM `articles` WHERE `id_article` = '" . $id . "'";
        return $db->queryOne($sql, 'Articles');
    }

    // Добавление статьи
    public static function articleAdd($title, $content)
    {
        // Подготовка
        $title = trim($title);
        $content = trim($content);

        // Проверка
        if ($title == '')
            return false;

        $db = new DB;

        // Запрос
        $sql = "
        INSERT INTO `articles`
        (`title`, `content`)
        VALUES
        ('" . $title . "', '" . $content . "')
        ";

        return $db->query($sql);
    }

    // == Редактирование статьи ==
    public static function articleEdit($id, $title, $content)
    {
        // Подготовка
        $id = (int)$id;
        $title = trim($title);
        $content = trim($content);

        // Проверка
        if ($title == '')
            return false;

        $db = new DB;

        // Запрос
        $sql = "UPDATE `articles` SET `title`='" . $title . "', `content`='" . $content . "' WHERE `id_article`='" . $id . "'";
        return $db->query($sql);
    }

    // == Удаление статьи ==
    public static function articleDelete($id)
    {
        $db = new DB;
        $sql = "DELETE FROM `articles` WHERE `id_article` = '" . $id . "'";
        return $db->query($sql);
    }
}