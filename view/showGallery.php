<?php
/**
 * Login-Formular
 * Das Formular wird mithilfe des Formulargenerators erstellt.
 */
require_once("../controller/GalleryController.php");

$gallerycontroller = new GalleryController();
foreach($gallerycontroller ->getGalleries() as $gallery){
    if ($gallery['UID'] == $_SESSION['uid']){
        ?>
        <div class="gallery">
            <h1><?php echo $gallery['galleryname']; ?></h1>
            <p><?php echo $gallery["decription"];?></p>
        </div>
        <?php
    }
}


$lblClass = "col-md-2";
$eltClass = "col-md-4";
$btnClass = "btn btn-success";
$form = new Form($GLOBALS['appurl']."/Gallery/showGallery");
$button = new ButtonBuilder();
echo $button->end();
echo $form->end();
?>
