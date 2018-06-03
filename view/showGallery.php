<?php
/**
 * Login-Formular
 * Das Formular wird mithilfe des Formulargenerators erstellt.
 */
require_once("../controller/GalleryController.php");
$gallerycontroller = new GalleryController();
$galleries = $gallerycontroller ->getGalleryFromUser($_SESSION['uid']);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            foreach($galleries as $gallery){
                if ($gallery['UID'] == $_SESSION['uid'] && $gallery['shared'] == 0){
                    ?>
                    <div class="gallery">
                        <?php echo "<a href=".$GLOBALS['appurl']."/Gallery/showGalleryDetail?galleryId=".$gallery['GID'].">";?>
                            <h1><?php echo $gallery['galleryname']; ?></h1>
                            <p><?php echo $gallery["decription"];?></p>
                        </a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Von dir Freigegeben</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            foreach($galleries as $gallery){
                if ($gallery['UID'] == $_SESSION['uid'] && $gallery['shared'] == 1){
                    ?>
                    <div class="gallery">
                        <?php echo "<a href=".$GLOBALS['appurl']."/Gallery/showGalleryDetail?galleryId=".$gallery['GID'].">";?>
                            <h1><?php echo $gallery['galleryname']; ?></h1>
                            <p><?php echo $gallery["decription"];?></p>
                        </a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>