<?php
// include("dbh.inc.php");


if (isset($_POST['signup-submit'])) {
    // run connection to db
    require 'dbh.inc.php';
    //get user inputs
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    //check to see if user compeleted form
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.pgp?error=emptyfields&uid=" . $username . "&email=" . $email);
        exit();

        //check for valid email and username
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidmailuid");
        exit();

        //check for valid email
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid=" . $username);
        exit();
    }
    //check for valid email
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduid&mail=" . $email);
        exit();
    }

    //check if the tow passwords match
    else if ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&uid=" . $username . "&email=" . $email);
        exit();
    } else {
        $sql = "SELECT uidUsers FROM users WHERE uidUsers =?;";
        $stmt = mysqli_stmt_init($conn);
        //check if we can run statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            //if it failed
            header("Location: ../signup.php?error=sqlerror");
            exit();
            //no errors in db, add info to db
        } else {
            //run
            mysqli_stmt_bind_param($stmt, "s", $sql);
            mysqli_stmt_execute($stmt);
            //did we get a match?
            mysqli_stmt_store_result($stmt);
            //how many result in stmt either 0 or 1.
            $resultCheck - mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken" . "&email=" . $email);
                exit();
            } else {
                $sql = "INSERT INTO users (uidUsers, emailusers, pwdUsers) VALUES (?,?,?)";
                //run new statement
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    //if it failed
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                } else {
                    //hash password
                    $hasedPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hasedPwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=succsees");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../signup.php");
    exit();
}
