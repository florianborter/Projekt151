<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 01.05.2018
 * Time: 08:24
 */

class MemberbereichController
{
    /**
     * Default-Seite für das Login: Zeigt das Login-Formular an
     * Dispatcher: /memberbereich
     */
    public function index()
    {
        $view = new View('memberbereich');
        $view->title = 'Bilder-DB';
        $view->heading = 'Memberbereich';
        $view->display();

        echo $_SESSION['uid'];
    }

    public function showGallery()
    {
        $view = new View('showGallery');
        $view->title = 'Bilder-DB';
        $view->heading = 'Deine Galerien';
        $view->display();

    }

    public function createGallery()
    {
        $view = new View('createGallery');
        $view->title = 'Bilder-DB';
        $view->heading = 'Erstelle eine neue Galerie';
        $view->display();

    }
}