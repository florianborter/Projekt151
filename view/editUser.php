<?php
$userController = new UserController();
$user = $userController->getUser();
?>
<div class="container">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <?php $action = $GLOBALS['appurl'] . "/User/executeFunction";?>
            <form class='form-horizontal' action='<?=$action?>' method='post' enctype='multipart/form-data' onsubmit="return confirm('Änderungen wirklich übernehmen? Ja/Nein')">
                <input type="text" class="notRendered" name="functionEditUser" value="editUser">
                <div class="row">
                    <p>Nickname:</p>
                </div>
                <div class="row">
                    <input type="text" name="nickname" placeholder="Nickname" value="<?= $user['nickname'] ?>">
                </div>
                <div class="row">
                    <p style="margin-top: 10px">Email des Users:</p>
                </div>
                <div class="row">
                    <input type="text" name="email" placeholder="Email" value="<?= $user['email'] ?>">
                </div>
                <div class="row">
                    <p style="margin-top: 10px">Neues Passwort:</p>
                </div>
                <div class="row">
                    <input type="password" name="passphrase" placeholder="Passwort" value="">
                </div>
                <div class="row">
                    <p style="margin-top: 10px">Wiederhole das Passwort:</p>
                </div>
                <div class="row">
                    <input type="password" name="passphrase2" placeholder="Passwort" value="">
                </div>

                <div class="row">
                    <div style="text-align: left; margin-top: 10px">
                        <button class="btn btn-success" name="send" type="submit">User aktualisieren</button>
                    </div>
                </div>
            </form>
            <?php
            $text = $_SESSION['editUserInfo'];
            echo "<p>$text</p>";
            ?>
            <div class="row">
                <div style="text-align: left; margin-top: 10px">
                    <?php $action = $GLOBALS['appurl'] . "/User/executeFunction";?>
                    <form class='form-horizontal' action='<?=$action?>' method='post' enctype='multipart/form-data' onsubmit="return confirm('Wirklich löschen? Ja/Nein')">
                        <input type="text" class="notRendered" name="functionEditUser" value="deleteUser">
                        <button class="btn btn-danger" name="send" type="submit">Account löschen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>