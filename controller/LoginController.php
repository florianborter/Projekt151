<?php
require_once '../repository/LoginRepository.php';
/**
 * Controller für das Login und die Registration, siehe Dokumentation im DefaultController.
 */
  class LoginController
  {
      /**
     * Default-Seite für das Login: Zeigt das Login-Formular an
	 * Dispatcher: /login
     */
    public function index()
    {
      $loginRepository = new LoginRepository();
      $view = new View('login_index');
      $view->title = 'Bilder-DB';
      $view->heading = 'Login';
      $view->display();
      $_SESSION['registrationInfo'] = "";
    }
    /**
     * Zeigt das Registrations-Formular an
	 * Dispatcher: /login/registration
     */
    public function registration()
    {
      $view = new View('login_registration');
      $view->title = 'Bilder-DB';
      $view->heading = 'Registration';
      $view->display();
      $_SESSION['loginInfo'] = "";
      if (!empty($_POST)) {
          $this->addUser();
      }
    }

    public function addUser(){
        $loginRepo = new LoginRepository();
        $regex = "#(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$#";
        $uniqueEmail = true;
        $emails = $loginRepo->getEmails();
        $postEmail = htmlspecialchars($_POST["email"]);
        $postNickname = htmlspecialchars($_POST["nickname"]);

        foreach ($emails as $email){
            if($postEmail == $email["email"]){
                $uniqueEmail = false;
                break;
            } else{
                $uniqueEmail = true;
            }
        }

        if($_POST["password"] == $_POST["password_check"] && preg_match($regex, $_POST["password"]) && $uniqueEmail){
            $loginRepo->addUser($postNickname, $postEmail, $_POST["password"]);
            $_SESSION['registrationInfo'] = "";
            header("Location: ".$GLOBALS['appurl']."/Login/index");
        }else{
            $_SESSION['registrationInfo'] = "Registration war nicht erfolgreich";
            header("Refresh:0");
        }

    }

    public function getDataLogin(){
        $loginRepo = new LoginRepository();

        $loginEMail = $_POST["email"];
        $loginPassword = $_POST["password"];

        $rows = $loginRepo->getIdEmailAndPassphrase();
        foreach ($rows as $row){
            if ($row["email"] == $loginEMail && password_verify($loginPassword, $row["passphrase"]) /*$row["passphrase"] == $loginPassword*/){
                $_SESSION['uid'] = $row['uid'];
                if ($_SESSION['uid'] > 0){
                    $uid = $_SESSION['uid'];
                    $path = "./../img/$uid";
                    $thumbPath = "./../img/$uid/thumb";
                    if (!file_exists($path)) {
                        mkdir("$path", 0777, true);
                        mkdir("$thumbPath", 0777, true);
                    }
                    header("Location: ./../public/memberbereich");
                    $_SESSION['loginInfo'] = "";
                }
            } else {

                $_SESSION['loginInfo'] = "Benutzername oder Passwort falsch";
            }
        }
    }
}
?>