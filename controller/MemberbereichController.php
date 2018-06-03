<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 01.05.2018
 * Time: 08:24
 */

class MemberbereichController
{
    public function index()
    {
        $view = new View('memberbereich');
        $view->title = 'Bilder-DB';
        $view->heading = 'Memberbereich';
        $view->display();

    }
}