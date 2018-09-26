<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 26.05.2018
 * Time: 16:16
 */
require_once("../repository/LoginRepository.php");
require_once("../repository/UserRepository.php");

class UserController
{
    public function showEditUser(){
        $view = new View('editUser');
        $view->title = 'Bilder-DB';
        $view->heading = 'Benutzer bearbeiten';
        $view->display();
        $_SESSION['createGalleryInfo'] = "";
        $_SESSION['editGalleryInfo'] = "";
        $_SESSION['addPictureInfo'] = "";
    }

    public function getUser(){
        $userRepo = new UserRepository();
        $result = $userRepo->getUser($_SESSION['uid']);
        $array = json_decode(json_encode($result), true);
        return $array;
    }

    public function executeFunction(){
        if (isset($_POST) && isset($_POST['functionEditUser'])){
            $functionToExecute = $_POST['functionEditUser'];
            if($functionToExecute == "editUser"){
                $this->editUser(htmlspecialchars($_POST['nickname']), htmlspecialchars($_POST['email']), htmlspecialchars($_POST['passphrase']), htmlspecialchars($_POST['passphrase2']));
                header("Location: ".$GLOBALS['appurl']."/User/showEditUser");
            }
            if($functionToExecute == "deleteUser"){
                $this->deleteUser($_SESSION['uid']);
                header("Location: ".$GLOBALS['appurl']."/logout");
            }
        }
    }

    public function editUser($nickname, $email, $passphrase, $passphrase2){
        $loginRepo = new LoginRepository();
        $userRepo = new UserRepository();
        $regex = "#(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$#";
        if($passphrase!="" && $passphrase2!=""){
            if($passphrase==$passphrase2){
                if(preg_match($regex, $passphrase)){
                    $passphrase = md5($passphrase);
                    $userRepo->editPassphrase($passphrase, $_SESSION['uid']);
                    $_SESSION['editUserInfo'] = "Änderungen wurden übernommen";
                } else{
                    $_SESSION['editUserInfo'] = "Passwörter sind zu schwach";
                }
            } else{
                $_SESSION['editUserInfo'] = "Passwörter stimmen nicht überein";
            }
        }

        if($nickname != "" && $email != ""){
            $uniqueEmail = true;
            $emails = $loginRepo->getEmails();
            $user = $this->getUser();

            foreach ($emails as $userEmail){
                if($email == $userEmail["email"] && $email != $user['email']){
                    $uniqueEmail = false;
                    break;
                } else{
                    $uniqueEmail = true;
                }
            }
            if($uniqueEmail){
                $userRepo->editUserNicknameAndEmail($nickname, $email, $_SESSION['uid']);
                $_SESSION['editUserInfo'] = "Änderungen wurden übernommen";
            } else {
                $_SESSION['editUserInfo'] = "Email ist nicht eindeutig";
            }
        }else{
            $_SESSION['editUserInfo'] = "Nickname und/oder email dürfen nicht leer sein";
        }
    }

    public function deleteUser($uid){

        $dir = "./../img/$uid";
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
            RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($dir);

        $userRepo = new UserRepository();
        $userRepo->deleteUser($uid);
    }
}