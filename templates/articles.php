<a href="../index2.php?act=Add"><button>Добавить статью</button></a>
<?php foreach ($articles as $article): ?>
    <article>
        <h3><a href="../index2.php?act=One&id=<?= $article->id_article ?>"><?= $article->title ?></a></h3>
        <em>Опубликовано: <?= $article->date ?> | Просмотров: <?= $article->views ?></em>
        <br>
        <p><?= ArticlesController::articleIntro($article->content, 10) ?></p>
        <a href="../index2.php?act=One&id=<?= $article->id_article ?>">Читать статью</a> |
        <a href="../index2.php?act=Edit&id=<?= $article->id_article ?>">Редактировать статью</a> |
        <a href="../index2.php?act=Delete&id=<?= $article->id_article ?>">Удалить статью</a>
    </article>
<?php endforeach; ?>
<br>