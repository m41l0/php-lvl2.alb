<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="./templates/css/style.css">
</head>
<body>
<div class="inner">
    <h1 class="head">Бложек без головы и ножек</h1>
    <?php

    if (isset($article)) {
        echo $article;
    } elseif (isset($articles)) {
        echo $articles;
    } elseif (isset($editor)) {
        echo $editor;
    } elseif (isset($add)) {
        echo $add;
    } else echo 'Ошибка подключения шаблона';

    ?>
</div>
</body>
</html>