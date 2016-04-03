<?php

// Подключение модели
include_once __DIR__ . '/models/main.php';

// Инициализация перменной
if (isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "";

// == Вывод статьи ==
if ($action == "read")
{
    $title = 'Статья';

    if (!empty($_GET['id'])) {
        $article = template(__DIR__ . '/templates/article.php', array('article' => articles_get($_GET['id'])));
        $layout = template(__DIR__ . '/templates/layout.php', array('title' => $title, 'article' => $article));
        counter($_GET['id']);

        echo $layout;
    }
}
// == Добавление статьи ==
elseif ($action == "add")
{
    $title = 'Добавление статьи';

// Обработка отправки формы.
    if (!empty($_POST)) {
        if (article_new($_POST['title'], $_POST['content'])) {
            header('Location: /');
            die();
        }

        $titl = $_POST['title'];
        $content = $_POST['content'];
        $error = true;
    } else {
        $titl = '';
        $content = '';
        $error = false;
    }

// Кодировка
    header('Content-type: text/html; charset=utf-8');

// Вывод в шаблон
    $add = template(__DIR__ . '/templates/add.php', array('error' => $error, 'titl' => $titl, 'content' => $content));
    $layout = template(__DIR__ . '/templates/layout.php', array('title' => $title, 'add' => $add));

    echo $layout;
}
// == Редактирование статьи ==
else if ($action == "edit") {
    $title = 'Редактирование статьи';

    if (!empty($_GET['id'])) {
        $id = (int)$_GET['id'];

        if (!empty($_POST)) {
            $title = $_POST['title'];
            $content = $_POST['content'];

            article_edit($id, $title, $content);
            header('Location: /');
        }
    } else header('Location: /');

    $editor = template(__DIR__ . '/templates/edit.php', array('article' => articles_get($id)));
    $layout = template(__DIR__ . '/templates/layout.php', array('title' => $title, 'editor' => $editor));

    echo $layout;
}
// == Удаление статьи ==
else if ($action == "delete") {
    if (!empty($_GET['id'])) {
        $id = (int)$_GET['id'];
        article_delete($id);
        header('Location: /');
    } else echo 'Упс! Какая-то ошибка!';
}
// == Вывод главной страницы ==
else {
    $title = 'Главная';

    $articles = template(__DIR__ . '/templates/articles.php', array('articles' => articles_all()));
    $layout = template(__DIR__ . '/templates/layout.php', array('title' => $title, 'articles' => $articles));

    echo $layout;
}