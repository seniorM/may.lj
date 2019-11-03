<?php

use core\Route;

$errors = core\Route::getErrors();
?>
<form action="<?= url('/auth/regproc') ?>" method="post">
    <ul>
        <?php
        if (count($errors) !== 0) {
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
        }
        ?>
    </ul>
    <label>Login:
        <input type="text" name="login" value="<?= $_SESSION['login'] ?>" required/>
    </label>
    <label>Password:
        <input type="password" name="pass" required/>
    </label>
    <label>Confirm password:
        <input type="password" name="pass_conf" required/>
    </label>
    <label>Email:
        <input type="email" name="email" value="<?= $_SESSION['email'] ?>" required/>
    </label>
    <input type="submit" value="зарегистрироваться"/>
</form>
<?php
Route::clearSession();
