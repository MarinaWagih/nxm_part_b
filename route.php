<?php
require_once('classes/Controller/UserController.php');
switch ($_GET['path']){
    case 'user-save':
        if(!isset($_SESSION)) session_start();
        $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
        if (!$token ||!isset( $_SESSION['token']) || $token !== $_SESSION['token']) {
            $_POST['errors']= ['token'=>'invalid csrf token'];
            ob_start();
            include "index.php";
            $str=ob_get_clean();
            echo $str;
            exit();
        }
        $u=new UserController();
        $u->create();
        break;
}