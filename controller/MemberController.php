<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 03.05.2018
 * Time: 08:29
 */

class MemberController
{
    public function index(){
        //$MembereRepository = new MemberRepository();
        $view = new View('member_index');
        $view->title = 'Bilder-DB';
        $view->heading = 'Memberbereich';
        $view->display();
    }

    public  function memberbereich(){
        $this->index();
    }
}