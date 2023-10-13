<?php
session_start();
//PHP Mailer előkészítése az e-mail küldéshez késpbbi implementációhoz

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


 

    require($_SERVER['DOCUMENT_ROOT']."/Webshop/vendor/autoload.php");
    
    require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/php/dbase.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/php/functions.php");
   
    
    // szükséges osztályok definiálása 
    class User{
       public $firstName;
       public $lastName;
       public $userName;
       public $userEmail;
       public $userPass;
       public $confirmPass;
       public $isAdmin;
       public $phoneNumber;
       public $userCity;
       public $userStreet;
       public $doorNumber;
       public $zipNumber;



        public function CreateUser($firstName, $lastName,  $userName,  $userEmail,  $userPass,  $confirmPass,  $isAdmin, $phoneNumber, $userCity, $userStreet, $doorNumber, $zipNumber){
            $this->firstName =$firstName;
            $this->lastName =$lastName;
            $this->userName=$userName;
            $this->userEmail=$userEmail;
            $this->userPass=md5($userPass);
            $this->confirmPass=md5($confirmPass);
            $this->isAdmin=$isAdmin;
            $this->phoneNumber=$phoneNumber;
            $this->userCity=$userCity;
            $this->userStreet=$userStreet;
            $this->doorNumber=$doorNumber;
            $this->zipNumber=$zipNumber;
        }
        public function SetProp($key, $value){
            $this->$key = $value;
        }
        public function GetProps(User $user){
           return get_object_vars($user);
        }
        public function __destruct(){}

    }

// globális változók definiálása
$homepage ="http://localhost/webshop/";
?>