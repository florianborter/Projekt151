<?php
/**
 * Login-Formular
 * Das Formular wird mithilfe des Formulargenerators erstellt.
 */
require_once("../controller/GalleryController.php");

$gallerycontroller = new GalleryController();
$gallerycontroller ->showGallerys();

$lblClass = "col-md-2";
$eltClass = "col-md-4";
$btnClass = "btn btn-success";
$form = new Form($GLOBALS['appurl']."/memberbereich/showGallery");
$button = new ButtonBuilder();
echo $button->end();
echo $form->end();
?>
