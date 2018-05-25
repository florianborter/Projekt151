<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 24.05.2018
 * Time: 09:05
 */

require_once("../controller/GalleryController.php");
    $galleryController = new GalleryController();
    //wenn yves gepusht hat kann die gid von der Session genommen werden.
    //$gallery = $galleryController->getGallery($_SESSION['gid']);
    $gallery = $galleryController->getGallery(1);
    var_dump($gallery);

?>
<div class="container">
    <div class="row">
        <div class="col-md-9">

$gallerycontroller = new GalleryController();
        </div>
        <!--Edit bereich-->
        <div class="col-md-3">
            <div class="container">
                <div class="row">
                    <p>Name der Galerie:</p>
                    <p><?=$gallery['galleryname']?></p>
                </div>
            </div>
        </div>
    </div>
</div>

if (!empty($_POST)) {
    $gallerycontroller->pictureAdd();
}

$lblClass = "col-md-2";
$eltClass = "col-md-4";
$btnClass = "btn btn-success";
$form = new Form($GLOBALS['appurl']."/Gallery/showGalleryDetail");
$button = new ButtonBuilder();
echo $form->input()->label('Bilder auswählen')->name('fileToUpload')->type('file')->lblClass($lblClass)->eltClass($eltClass);
echo $button->start($lblClass, $eltClass);
echo $button->label('hinzufügen')->name('send')->type('submit')->class('btn-success');
echo $button->end();
echo $form->end();
?>