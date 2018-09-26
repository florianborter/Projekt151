<?php
/**
 * Login-Formular
 * Das Formular wird mithilfe des Formulargenerators erstellt.
 */
require_once("../controller/GalleryController.php");
$gallerycontroller = new GalleryController();
if (!empty($_POST)) {
    $gallerycontroller->create();
}
$lblClass = "col-md-2";
$eltClass = "col-md-4";
$btnClass = "btn btn-success";
$form = new Form($GLOBALS['appurl']."/Gallery/createGallery");
$button = new ButtonBuilder();
echo $form->input()->label('Name der Gallery')->name('namegallery')->type('text')->lblClass($lblClass)->eltClass($eltClass);
echo $form->input()->label('Beschreibung')->name('description')->type('text')->lblClass($lblClass)->eltClass($eltClass);
echo $button->start($lblClass, $eltClass);
echo $button->label('erstellen')->name('send')->type('submit')->class('btn-success');
echo $button->end();
echo $form->end();

$text = $_SESSION['createGalleryInfo'];
echo "<p>$text</p>";
?>
