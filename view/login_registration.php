<?php
  /**
   * Registratons-Formular
   * Das Formular wird mithilfe des Formulargenerators erstellt.
   */

    $logincontroller = new LoginController();



    $lblClass = "col-md-2";
    $eltClass = "col-md-4";
    $btnClass = "btn btn-success";
    $form = new Form($GLOBALS['appurl']."/login/registration");
    $button = new ButtonBuilder();
    echo $form->input()->label('Nickname')->name('nickname')->type('text')->lblClass($lblClass)->eltClass($eltClass);
    echo $form->input()->label('Email')->name('email')->type('email')->lblClass($lblClass)->eltClass($eltClass);
    echo $form->input()->label('Passwort')->name('password')->type('password')->lblClass($lblClass)->eltClass($eltClass);
    echo $form->input()->label('Passwort wiederholen')->name('password_check')->type('password')->lblClass($lblClass)->eltClass($eltClass);

    echo $button->start($lblClass, $eltClass);
    echo $button->label('Registrieren')->name('send')->type('submit')->class('btn-success');
    echo $button->end();
    echo $form->end();

    $text = $_SESSION['registrationInfo'];
    echo "<p>$text</p>";
 
?>
