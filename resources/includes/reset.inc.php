<?php

if (isset($_POST["reset"])) {

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://localhost/know-your-kanoon/public_html/create-new-pwd.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800; // date in seconds since 1970, 1 hour expiry

    require 'db.inc.php';

    $email = $_POST["email"];

    // check for existing token (token not expired)
    $sql = "DELETE FROM pwd_recovery WHERE email=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Error...";
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwd_recovery (email, selector, token, expires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Error...";
        exit();
    }
    else {
        $hashed_token = password_hash($token, PASSWORD_DEFAULT);    // default hashing method
        mysqli_stmt_bind_param($stmt, "ssss", $email, $selector, $token, $expires);
        mysqli_stmt_execute(); 
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Mailing service using PHPMailer
    require_once 'PHPMailer/PHPMailerAutoload.php';
    $message = "<p>We recieved a password reset request. Please click the link below to recover your password. If you didn't make this request, kindly ignore this email.</p>";
    $message .= "<p>Here is your password reset link: <br>" . "<a href='" . $url . "'></a></p>";
    $subject = 'Password Recovery Link for Your Account at Know Your Kanoon';
    $receiver = $email;

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = '587';
    $mail->isHTML();
    $mail->Username = 'example@example.com';
    $mail->Password = "password";
    $mail->SetFrom('no-reply@knowyourkanoon.com');
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AddAddress($receiver);
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }

    header("location: ../../public_html/login.php?reset=success");
}
else {
    header("location: ../../public_html/login.php");
}