<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 17.05.2018
 * Time: 08:59
 */

require_once("../repository/GalleryRepository.php");

class GalleryController
{
    public function create(){
        $galleryRepo = new GalleryRepository();
        //$imagename=$_FILES[$_POST["fileToUpload"]]['name'];

        $imagename=addslashes($_FILES["fileToUpload"]["name"]);
        $imageTemp=addslashes(file_get_contents(["fileToUpload"]['tmp_name']));
        $imageType=addslashes($_FILES["fileToUpload"]["type"]);

        $galleryRepo->createGallery($_POST["namegallery"], $_POST["description"],$_SESSION["uid"]);

        if(substr($imageType,0,5) =="image"){
            $galleryRepo->addPicture($imagename,$imageTemp);
        }
        else{
            echo "Nur Bilder sind erlaubt";
        }

    }

    public function showGallerys(){
        $galleryRepo = new GalleryRepository();
        $datas = $galleryRepo->getGalleryData();
        foreach($datas as $data){
            if ($data['UID'] == $_SESSION['uid']){
                ?>
                <div class="gallery">
                    <h1><?php echo $data['galleryname'];?></h1>
                    <p><?php echo $data["decription"];?></p>
                </div>
                <?php
            }
        }
    }
}
?>