<?php
require_once('classes/Controller/UserController.php');
switch ($_GET['path']){
    case 'user-save':
        $u=new UserController();
        $u->create();
        break;
}