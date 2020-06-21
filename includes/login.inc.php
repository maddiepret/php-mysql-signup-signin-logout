<?php

if (isset($_POST['signup-submit'])) {
    // run connection to db
    require 'dbh.inc.php';
    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];
    //check if emoty
    if (empty($mailuid) || empty($password)) {
        header("Location: ../signup.pgp?error=emptyfields");
        exit();
    } else {
        //chevk bd
        $sql = "SELECT * FROM users WHERE uidUsers =?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            //create err
            header("Location: ../signup.pgp?error=sqlerror");
            exit();
        } else {
            //grad info we got from db
            mysqli_stmt_bind_param($stmt, 'ss', $mailuid, $mailuid);
            //execute params
            mysqli_stmt_execute($stmt);
            //grab results and add to var
            $resulst = mysqli_stmt_get_result($stmt);
            //check if we got an result from db
            if ($row = mysqli_fetch_assoc($resulst)) {
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                if ($pwdCheck == false) {
                    header("Location: ../signup.pgp?error=WRONGPASSWORD");
                    exit();
                } else if ($pwdCheck == true) {
                    session_start();
                    $_SESSION[] = $row['idUser'];
                    $_SESSION[] = $row['uidUser'];
                    header("Location: ../signup.pgp?login=success");
                } else {
                    header("Location: ../signup.pgp?error=WRONGPASSWORD");
                    exit();
                }
            } else {
                header("Location: ../signup.pgp?error=nouser");
                exit();
            }
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
