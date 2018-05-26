<?php

/*
 * Die index.php Datei ist der Einstiegspunkt des MVC. Hier werden zuerst alle
 * vom Framework benötigten Klassen geladen und danach wird die Anfrage dem
 * Dispatcher weitergegeben.
 *
 * Wie in der .htaccess Datei beschrieben, werden alle Anfragen, welche nicht
 * auf eine bestehende Datei zeigen hierhin umgeleitet.
 */

    session_start();

if(!isset($_SESSION['once'])){
    $_SESSION['registrationInfo'] = "";
    $_SESSION['loginInfo'] = "";
    $_SESSION['createGalleryInfo'] = "";
    $_SESSION['editGalleryInfo'] = "";
    $_SESSION['addPictureInfo'] = "";
    $_SESSION['once'] = "ausgeführt";
}


  // fix schf: approot für url
  $GLOBALS['appurl'] = '/m151/bilderDb/public';
  $GLOBALS['numAppurlFragments'] = 3;

  require_once '../lib/Dispatcher.php';
  require_once '../lib/formbuilder/FormBuilder.php';
  require_once '../lib/View.php';

  $dispatcher = new Dispatcher();
  $dispatcher->dispatch();
?>