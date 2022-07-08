<?php
use NXM\Model\User;
use NXM\Helpers\CreditCard;
require_once('classes/Model/User.php');
require_once('classes/Helpers/CreditCard.php');
class UserController
{
    public function create(){
        $errors=$this->validate();
        $_POST['errors']=[];
        if($errors) {
            $_POST['errors']= $errors;
        }
        else{
            //concern no unique value to check on
            $data=[
                "name"=>filter_var($_POST['name'],FILTER_SANITIZE_STRING),
                "address"=>filter_var($_POST['address'],FILTER_SANITIZE_STRING),
                'is_credit_card_valid'=> isset($_POST['is_credit_card_valid']) && filter_var($_POST['is_credit_card_valid'],FILTER_SANITIZE_STRING),
                'birthdate'=> date("Y-m-d",strtotime($_POST['birthdate'])),
                'img'=> $this->saveImg(),

                "credit_card_number"=>filter_var($_POST['credit_card_number'],FILTER_SANITIZE_STRING),
                "credit_card_name"=>filter_var($_POST['credit_card_name'],FILTER_SANITIZE_STRING),
                "credit_card_cvv"=>filter_var($_POST['credit_card_cvv'],FILTER_SANITIZE_STRING),
                "credit_card_expiration_month"=>filter_var($_POST['credit_card_expiration_month'],FILTER_SANITIZE_STRING),
                "credit_card_expiration_year"=>filter_var($_POST['credit_card_expiration_year'],FILTER_SANITIZE_STRING),
            ];

            $user=new User();
            $user->save($data);
            $_POST['success']= true;
        }
        unset($_SESSION['token']);
        ob_start();
        include "index.php";
        $str=ob_get_clean();
        echo $str;
        exit();
    }

    private function validate()
    {
        $errors=[];

        if(empty($_POST['name'])||strlen($_POST['name'])>50){
            $errors['name']='name is required & length should be less than 50';
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
        if(empty($_FILES['img'])||empty($_FILES['img']["name"])){
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

        if(empty($_POST['credit_card_number'])){
            $errors['credit_card_number']='Credit Card Number is required';
        }else{
            $card = CreditCard::validCreditCard($_POST['credit_card_number']);
            if(!$card['valid']){
                $errors['credit_card_number']='Credit Card Number is Not valid';
            }
        }
        if(empty($_POST['credit_card_cvv'])){
            $errors['credit_card_cvv']='Credit Card CVV is required';
        }else if($card['valid']){
            $validCvc = CreditCard::validCvc($_POST['credit_card_cvv'], $card['type']);
            if(!$validCvc){
                $errors['credit_card_cvv']='Credit Card CVV is Not valid';
            }
        }
        if(empty($_POST['credit_card_expiration_month'])||empty($_POST['credit_card_expiration_year'])){
            $errors['credit_card_cvv']='Credit Card Expiration Date is required';
        }else {
            $validDate = CreditCard::validDate("20".$_POST['credit_card_expiration_year'], $_POST['credit_card_expiration_month']);
            if(!$validDate){
                $errors['credit_card_cvv']='Credit Card Expiration Date is Not valid';
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