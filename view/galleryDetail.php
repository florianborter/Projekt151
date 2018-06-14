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
                    <form method="POST" action="<?=$GLOBALS['appurl'] . "/Gallery/executeFunction"?>" enctype="multipart/form-data">
                        <input type="text" class="notRendered" name="functionGalleryDetail" value="addPicture">
                        <input type="file" name="fileToUpload">
                        <button type="submit" class="btn btn-success" name="send">Hinzufügen</button>
                    </form>
                    <?php
                    $text = $_SESSION['addPictureInfo'];
                    echo "<p>$text</p>";

                    foreach ($galleryController->getPicturesFromGallery($_SESSION['gid']) as $picture) {
                        $image_name=$picture["picturename"];
                        $image_path=$picture["path"];
                        $src = $image_path;
                        $src .= $image_name;
                        ?>
                        <div class="thumbnailCustom">
                            <?php $action = $GLOBALS['appurl'] . "/Gallery/executeFunction";?>
                            <form class='form-horizontal' action='<?=$action?>' method='post' enctype='multipart/form-data' onsubmit="return confirm('Bild wirklich ändern? Ja/Nein')">
                            <input type="text" class="notRendered" name="functionGalleryDetail" value="deleteImage<?=$picture['PID']?>">
                                <a href="<?=$src?>" target="_blank">
                                    <img src="<?=$src?>" alt="<?=$src?>">
                                </a>
                                <br>
                            <input type="text" name="updateText" value="<?=$picture['picturedescription']?>">
                            <h6>TODO: Tags</h6>
                            <button class="btn btn-success" name="update" type="submit">Bild aktualisieren</button>
                            <button class="btn btn-danger" name="send" type="submit">Dieses Bild löschen</button>
                            </form>
                        </div>
                        <?php
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