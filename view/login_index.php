<?php
  /**
   * Login-Formular
   * Das Formular wird mithilfe des Formulargenerators erstellt.
   */

  $logincontroller = new LoginController();

  if (!empty($_POST)) {
      $logincontroller->getDataLogin();
  }

  $lblClass = "col-md-2";
  $eltClass = "col-md-4";
  $btnClass = "btn btn-success";
  $form = new Form($GLOBALS['appurl']."/login");
  $button = new ButtonBuilder();
  echo $form->input()->label('E-Mail')->name('email')->type('text')->lblClass($lblClass)->eltClass($eltClass);
  echo $form->input()->label('Passwort')->name('password')->type('password')->lblClass($lblClass)->eltClass($eltClass);
  echo $button->start($lblClass, $eltClass);
  echo $button->label('Login')->name('send')->type('submit')->class('btn-success');
  echo $button->end();
  echo $form->end();

  $text = $_SESSION['loginInfo'];
  echo "<p>$text</p>";
?>
