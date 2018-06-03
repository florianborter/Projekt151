<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?=$GLOBALS['appurl']?>/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?=$GLOBALS['appurl']?>/css/style.css" >
	<script src="<?=$GLOBALS['appurl']?>/js/jscript.js"></script>
    <title><?= $title ?></title>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Bilder-DB</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
			<!-- fix schf -->
              <?php
                if (!isset($_SESSION['uid'])){
              ?>
                    <li><a href="<?=$GLOBALS['appurl']?>/sharedGalleries/showSharedGalleries">Freigegebene Galerien</a></li>
                    <li><a href="<?=$GLOBALS['appurl']?>/login">Login</a></li>
                    <li><a href="<?=$GLOBALS['appurl']?>/login/registration">Registration</a></li>
              <?php
                } else{
              ?>
                    <li><a href="<?=$GLOBALS['appurl']?>/sharedGalleries/showSharedGalleries">Freigegebene Galerien</a></li>
                    <li><a href="<?=$GLOBALS['appurl']?>/memberbereich">Meine Bilder</a></li>
                    <li><a href="<?=$GLOBALS['appurl']?>/Gallery/showGallery">Meine Galerien</a></li>
                    <li><a href="<?=$GLOBALS['appurl']?>/Gallery/createGallery">Galerie erstellen</a></li>
                    <li><a href="<?=$GLOBALS['appurl']?>/User/showEditUser">Benutzeroptionen</a></li>
                    <li><a href="<?=$GLOBALS['appurl']?>/logout">logout</a></li>
              <?php
                }
              ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container">
    <h3 style="padding-left: 15px"><?= $heading ?></h3>
