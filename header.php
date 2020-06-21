<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login System</title>
</head>

<body>
    <header>
        <nav>
            <a href="#">
                <img src="https://cdn.shopify.com/shopifycloud/hatchful-web/assets/6fcc76cfd1c59f44d43a485167fb3139.png" alt="logo" height="80px">
            </a>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">About me</a></li>
                <li><a href="#">Contact</a></li>

            </ul>
            <div>
                <form action="includes/login.inc.php" method="post">
                    <input type="text" name="mailuid" placeholder="Username/Email">
                    <input type="password" name="pwd" placeholder="Password">
                    <button type="submit" name="login-submit">Log in</button>
                    <a href="signup.php">Sign up</a>
                </form>
                <form action="includes/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button>
                </form>
            </div>
        </nav>
    </header>