<?php

require_once __DIR__ . '/../models/ArticlesModel.php';

class ArticlesController
{
    public function actionAll()
    {
        $articles = Articles::getAll();
        include __DIR__ . '/../templates/articles.php';
    }

    // Интро статьи
    // TODO Перенести в модель
    public static function articleIntro($content, $max_words)
    {
        $words = explode(' ', $content);

        if (count($words) > $max_words && $max_words > 0) {
            $content = implode(' ', array_slice($words, 0, $max_words)) . '...';
        }

        return $content;
    }    
    
    public function actionOne()
    {
        $id = $_GET['id'];
        $article = Articles::getOne($id);
        include __DIR__ . '/../templates/article.php';
    }

    // == Добавление статьи ==
    public function actionAdd()
    {
        $title = 'Добавление статьи';

        // Обработка отправки формы.
        if (!empty($_POST)) {
            if (Articles::articleAdd($_POST['title'], $_POST['content'])) {
                header('Location: index2.php');
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

        include __DIR__ . '/../templates/add.php';
    }

    // == Редактирование статьи ==
    public function actionEdit()
    {
        $title = 'Редактирование статьи';

        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
            $article = Articles::getOne($id);

            if (!empty($_POST)) {
                $title = $_POST['title'];
                $content = $_POST['content'];

                Articles::articleEdit($id, $title, $content);
                header('Location: index2.php');
            }
        } else header('Location: index2.php');

        include __DIR__ . '/../templates/edit.php';
    }

    // == Удаление статьи ==
    public function actionDelete()
    {
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
            Articles::articleDelete($id);
            header('Location: index2.php');
        } else echo 'Упс! Какая-то ошибка!';
    }
}