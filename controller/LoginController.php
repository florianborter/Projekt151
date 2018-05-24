<?php
require_once '../repository/LoginRepository.php';
/**
 * Controller für das Login und die Registration, siehe Dokumentation im DefaultController.
 */
  class LoginController
  {

    public $info = "";
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
      if (!empty($_POST)) {
          $this->addUser();
      }
    }

    public function addUser(){
        $loginRepo = new LoginRepository();
        $regex = "#(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$#";
        $uniqueEmail = true;
        $emails = $loginRepo->getEmails();

        foreach ($emails as $email){
            if($_POST["email"] == $email["email"]){
                $uniqueEmail = false;
                break;
            } else{
                $uniqueEmail = true;
            }
        }

        if($_POST["password"] == $_POST["password_check"] && preg_match($regex, $_POST["password"]) && $uniqueEmail){
            $loginRepo->addUser($_POST["nickname"], $_POST["email"], $_POST["password"]);
            $this->info = "Registration erfolgreich";
        }else{
            $this->info = "Registration war nicht erfolgreich";
        }

    }

    public function getDataLogin(){
        $loginRepo = new LoginRepository();

        $loginEMail = $_POST["email"];
        $loginPassword = $_POST["password"];
        $loginPassword = md5($loginPassword);

        $rows = $loginRepo->getIdEmailAndPassphrase();

        foreach ($rows as $row){
            if ($row["email"] == $loginEMail && $row["passphrase"] == $loginPassword){
                $_SESSION['uid'] = $row['uid'];
                if ($_SESSION['uid'] > 0){
                    header("Location: ./../public/memberbereich");
                }
            } else {
                echo "notworking";
            }
        }
    }
}
?>