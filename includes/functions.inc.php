<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwd_repeat) {
    $result;
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwd_repeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUsername($username) {
    $result = true;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } 
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwd_repeat) {
    $result;
    if ($pwd !== $pwd_repeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function userExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn); // prevent SQL Injection
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);   // ss -> datatype being sent
    mysqli_stmt_execute($stmt);

    $results_data = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($results_data)) {    // check if exists in assosciative array
        return $row;    // return all related data if user exists
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pwd) {
    $sql = "INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?);";  // placeholder used while binding parameter
    $stmt = mysqli_stmt_init($conn);         // prevent SQL Injection
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);    // default algorithm

    mysqli_stmt_bind_param($stmt, "ssss", $name, $username, $email, $hashed_pwd);   // ss -> datatype being sent
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../register.php?error=none");
    exit();
}

function emptyInputLogin($username, $pwd) {
    $result;
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd) {
    $username_exists = userExists($conn, $username, $username);

    if ($username_exists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwd_hashed = $username_exists["password"];
    $check_pwd = password_verify($pwd, $pwd_hashed);

    if ($check_pwd === false) {
        header("location: ../login.php?error=incorrectlogin");
    }
    elseif ($check_pwd === true) {
        session_start();
        $_SESSION["id"] = $username_exists["id"];
        $_SESSION["name"] = $username_exists["name"];
        $_SESSION["username"] = $username_exists["username"];
        $_SESSION["email"] = $username_exists["email"];
        $_SESSION["joined_on"] = $username_exists["created_at"];
        header("location: ../services.php");
        exit();
    }
}