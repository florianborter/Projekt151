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
                    $lblClass = "col-md-4";
                    $btnClass = "col-md-2";
                    $eltClass = "btn btn-success";
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
                    $text = $_SESSION['addPictureInfo'];
                    echo "<p>$text</p>";

                    $allePictures = $galleryController->getPictures();

                    while($picture = $allePictures->fetch_assoc()){
                        if ($picture['GID'] == $_SESSION['gid']) {

                            echo '<img src="data:image/jpeg;base64,' . base64_encode($picture['image']) . '"';


                        }
                    }
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
                        <textarea rows="3" cols="22" name="decription" placeholder="Beschreibung"><?=$gallery['decription']?></textarea>
                    </div>
                    <div class="row">
                        <?php
                            if($gallery['shared'] == 0){
                                echo '<input type="checkbox" name="shared" value="checked"> ist Freigegeben';
                            }else{
                                echo '<input type="checkbox" name="shared" value="checked" checked> ist Freigegeben';
                            }
                        ?>
                    </div>
                    <div class="row">
                        <div style="text-align: left">
                            <button class="btn btn-success" name="send" type="submit">Galerie aktualisieren</button>
                        </div>
                    </div>
                    <?php
                    echo $form->end();
                    $text = $_SESSION['editGalleryInfo'];
                    echo "<p>$text</p>";
                    ?>
                    <div class="row">
                        <div style="text-align: left; margin-top: 10px">
                            <?php $action = $GLOBALS['appurl'] . "/Gallery/executeFunction";?>
                            <form class='form-horizontal' action='<?=$action?>' method='post' enctype='multipart/form-data' onsubmit="return confirm('Wirklich löschen? Ja/Nein')">
                                <input type="text" class="notRendered" name="functionGalleryDetail" value="deleteGallery">
                                <button class="btn btn-danger" name="send" type="submit">Galerie löschen</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
?>