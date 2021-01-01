<?php

if (isset($_POST["reset_pwd_submit"])) {
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $pwd = $_POST["pwd"];
    $pwd_repeat = $_POST["pwd_repeat"];

    if (empty($pwd) || empty($pwd_repeat)) {
        $redirect = "location: ../../public_html/create-new-pwd.php?error=emptyinput&selector=" . $selector . "&validator=" . $validator;
        header($redirect);
        exit();
    }
    elseif ($pwd != $pwd_repeat) {
        $redirect = "location: ../../public_html/create-new-pwd.php?error=pwdnomatch&selector=" . $selector . "&validator=" . $validator;
        header($redirect);
        exit();
    }

    // Check if token has expired
    $current_date = date("U");

    require 'db.inc.php';

    $sql = "SELECT * FROM pwd_recovery WHERE selector=? AND expires>=$current_date;";    // SQL Injection does not take place with program defined variables
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Error...";
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $selector);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {  // no results
            echo "resubmit your reset request";
            exit();
        }   // refer to data with column names -> associative array
        else {
            $token_bin = hex2bin($validator);
            $token_check = password_verify($token_bin, $row["token"]);

            if ($token_check === false) {
                echo "Resubmit your reset request";
                exit();
            }
            elseif ($token_check === true) {
                $email = $row["email"]; // Password Recovery Email

                $sql = "SELECT * FROM users WHERE email=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "Error...";
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {  
                        echo "Resubmit your reset request";
                        exit();
                    }   
                    else {
                        $sql = "UPDATE users SET pwd=? WHERE email=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "Error...";
                            exit();
                        }
                        else {
                            $hashed_new_pwd = password_hash($pwd, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $hashed_new_pwd, $email);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwd_recovery WHERE email=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "Error...";
                                exit();
                            }
                            else {
                                mysqli_stmt_bind_param($stmt, "s", $email);
                                mysqli_stmt_execute($stmt);
                                header("location: ../../public_html/login.php?newpwd=updated");
                            }
                        }
                    }
                }
            }
        }
    }
}
else {
    header("location: ../../public_html/login.php");
}