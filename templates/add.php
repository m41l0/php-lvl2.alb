<h1>Новая статья</h1>
<?php
if ($error)
    echo '<b class="warning">Заполните все поля!</b>';
?>
<form method="post">
    Название:
    <br>
    <input type="text" name="title" value="<?= $titl ?>" size="70" required autofocus>
    <br>
    <br>
    Содержание:
    <br>
    <textarea name="content" cols="80" rows="8" required><?= $content ?></textarea>
    <br>
    <input type="submit" value="Добавить">
</form>
<hr>
<a href="../index2.php"><= К списку статей</a>