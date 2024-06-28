<?php
session_start();

$errors = [];
if (empty($_REQUEST["name"])) $errors["name"]= " Name is required";
if (empty($_REQUEST["email"])) $errors["email"]= " Email is required";
if (empty($_REQUEST["password"])) $errors["password"]= " Password is required";
if (empty($_REQUEST["password confirmation"])) $errors[" password confirmation"]= " password confirmation is required";
else if ($_REQUEST["password"] != $_REQUEST[" password confirmation"])
{

   $errors[" password confirmation"]= " password confirmation must equal password!";
    
}

$name = htmlspecialchars (trim($_REQUEST ["name" ])) ;
$email = filter_var($_REQUEST["email" ],FILTER_SANITIZE_EMAIL) ;
$password = htmlspecialchars($_REQUEST["pw" ]) ;
$password_confirmation =htmlspecialchars($_REQUEST["pc" ]) ;
$phone = htmlspecialchars($_REQUEST["phone"]);

if (!empty($_REQUEST["email"]) && !filter_var($_REQUEST["email"],FILTER_VALIDATE_EMAIL)) $errors["email"]="Email invalid";

if(empty($errors)){
    
    require_once('classes.php');
    try{
   $rslt = Subscriber::register($name, $email,md5($password), $phone);
   header("location:index.php?msg=sr");}catch(\Throwable $cn){
     header("location:index.php?msg=fr");}
}
else{
    $_SESSION["errors"]=$errors;
    header("location:register.php")
;}