<?php

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $pwd_repeat = $_POST["pwd_repeat"];
    
    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($name, $email, $username, $pwd, $pwd_repeat) !== false){
        header("location: ../../public_html/register.php?error=emptyinput");
        exit();
    }
    if (invalidUsername($username) !== false){
        header("location: ../../public_html/register.php?error=invalidusername");
        exit();
    }
    if (invalidEmail($email) !== false){
        header("location: ../../public_html/register.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd, $pwd_repeat) !== false){
        header("location: ../../public_html/register.php?error=pwdnomatch");
        exit();
    }
    if (userExists($conn, $username, $email) !== false){
        header("location: ../../public_html/register.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $email, $username, $pwd);
}
else {
    header("location: ../../public_html/register.php");
    exit();
}