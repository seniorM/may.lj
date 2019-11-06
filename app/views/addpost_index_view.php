<?php
$errors = getErrors();
?>
<form action="/posts" method="post" id="save">
    <?= csrf() ?>
    <ul>
        <?php
        if (count($errors) !== 0) {
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
        }
        ?>
    </ul>
    <label>Title:
        <input type="text" name="title" value="<?= $_SESSION['title'] ?>" required />
    </label>
    <label>Text post:
        <textarea id="editor1" rows="10" cols="72" name="text" id="editor" value="<?= $_SESSION['text'] ?>" required></textarea>

    </label>

    <input type="submit" value="add post"/>
</form>

<?php
//чтобы не сохранились к следующему запуску
$_SESSION['errors'] = null;
$_SESSION['title'] = null;
$_SESSION['text'] = null;

