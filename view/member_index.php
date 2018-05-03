<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 03.05.2018
 * Time: 08:24
 */

    $MemberController = new MemberController();

    if (!empty($_POST)) {
        $MemberController->index();
    }

    $lblClass = "col-md-2";
    $eltClass = "col-md-4";
    $btnClass = "btn btn-success";
    $form = new Form($GLOBALS['appurl']."/member/memberbereich");/*member=MemberController/memberbereich=Methode*/

    $dir = glob('../img/{*.jpg,*.png}',GLOB_BRACE);
    foreach ($dir as $value){

        ?>
    <img src="<?php echo $value ?>" alt="<?php echo $value;?>">
    <?php
    }