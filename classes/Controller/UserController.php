<?php
use NXM\Model\User;
require_once('classes/Model/User.php');
class UserController
{
    public function create(){
        $errors=$this->validate();
        $_POST['errors']=[];
        if($errors) {
            $_POST['errors']= $errors;
        }
        else{
            $data=[
                "name"=>filter_var($_POST['name'],FILTER_SANITIZE_STRING),
                "address"=>filter_var($_POST['address'],FILTER_SANITIZE_STRING),
                'is_credit_card_valid'=> isset($_POST['is_credit_card_valid']) && filter_var($_POST['is_credit_card_valid'],FILTER_SANITIZE_STRING),
                'birthdate'=> date("Y-m-d",strtotime($_POST['birthdate'])),
                'img'=> $this->saveImg(),
            ];

            $user=new User();
            $user->save($data);
            $_POST['success']= true;
        }
        ob_start();
        include "index.php";
        $str=ob_get_clean();
        echo $str;
        exit();
    }

    private function validate()
    {
        $errors=[];

        if(empty($_POST['name'])){
            $errors['name']='name is required';
        }
        if(empty($_POST['birthdate'])){
            $errors['birthdate']='birthdate is required';
        }
        elseif (strtotime($_POST['birthdate'])===false||strtotime($_POST['birthdate'])>time()){
            $errors['birthdate']='invalid birthdate';
        }
        if(empty($_POST['address'])){
            $errors['address']='address is required';
        }
        if(empty($_FILES['img'])){
            $errors['img']='img is required';
        }else{
            $check = getimagesize($_FILES["img"]["tmp_name"]);
            $imageFileType = strtolower(pathinfo($_FILES["img"]["name"],PATHINFO_EXTENSION));

            if($check === false) {
                $errors['img']="File is not an image.";
            }elseif ($_FILES["img"]["size"] > 500000) {
                $errors['img']="Sorry, your file is too large.";
            }elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $errors['img']="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        }
        return $errors;
    }
    private function saveImg()
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . uniqid(rand(), true);
        $imageFileType = strtolower(pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION));
        $target_file .= ".$imageFileType";
        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
        return $target_file;
    }
}