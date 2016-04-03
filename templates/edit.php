<h1><?= $article->title ?></h1>
<form method="post">
    Название:
    <br>
    <input type="text" name="title" value="<?= $article->title ?>" size="70" required>
    <br>
    <br>
    Содержание:
    <br>
    <textarea name="content" cols="80" rows="8" required><?= $article->content ?></textarea>
    <br>
    <input type="submit" value="Сохранить">
</form>
<hr>
<a href="../index2.php"><= К списку статей</a>