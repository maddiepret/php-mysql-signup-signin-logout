<?php include("header.php") ?>
<main>
    <?php if (isset($_SESSION['userId'])) {
        echo '<p>Welcome, you are logged in!</p>';
    } else {
        echo '<p>You are logged out!</p>';
    }

    ?>

</main>
<?php include("footer.php") ?>