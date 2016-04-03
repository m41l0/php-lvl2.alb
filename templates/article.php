<a href="../index2.php"><= К списку статей</a>
<article>
    <h3><?= $article->title ?></h3>
    <em>Опубликовано: <?= $article->date ?> | Просмотров: <?= ++$article->views ?></em>
    <p><?= $article->content ?></p>
</article>