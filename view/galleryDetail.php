<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 24.05.2018
 * Time: 09:05
 */

require_once("../controller/GalleryController.php");
    $galleryController = new GalleryController();
    if(!isset($_GET['galleryId'])) {
        $gallery = $galleryController->getGallery($_SESSION['gid']);

        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php

                    $lblClass = "col-md-2";
                    $eltClass = "col-md-4";
                    $btnClass = "btn btn-success";
                    $form = new Form($GLOBALS['appurl'] . "/Gallery/executeFunction");
                    ?>
                    <input type="text" class="notRendered" name="functionGalleryDetail" value="addPicture">
                    <?php
                    $button = new ButtonBuilder();
                    echo $form->input()->label('Bilder auswählen')->name('fileToUpload')->type('file')->lblClass($lblClass)->eltClass($eltClass);
                    echo $button->start($lblClass, $eltClass);
                    echo $button->label('hinzufügen')->name('send')->type('submit')->class('btn-success');
                    echo $button->end();
                    echo $form->end();
                    ?>
                </div>
                <!--Edit bereich-->
                <div class="col-md-3">
                    <?php
                    $form = new Form($GLOBALS['appurl'] . "/Gallery/executeFunction");
                    ?>
                    <input type="text" class="notRendered" name="functionGalleryDetail" value="updateGallery">
                    <div class="row">
                        <p>Name der Galerie:</p>
                    </div>
                    <div class="row">
                        <input type="text" name="galleryname" placeholder="Name" value="<?= $gallery['galleryname'] ?>">
                    </div>
                    <div class="row">
                        <p style="margin-top: 10px">Beschreibung der Galerie:</p>
                    </div>
                    <div class="row">
                        <input type="text" name="decription" placeholder="Beschreibung"
                               value="<?= $gallery['decription'] ?>">
                    </div>
                    <div class="row">
                        <div style="margin-top: 15px; float: left;">
                            <?php
                            echo $button->start($lblClass, $eltClass);
                            echo $button->label('aktualisieren')->name('send')->type('submit')->class('btn-success');
                            echo $button->end();
                            ?>
                        </div>
                    </div>
                    <?php
                    echo $form->end();
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
?>