<?php
if (isset($_POST['resetter'])) {
    session_name("Edvin");
    session_start();
    $_SESSION['counter'] = 0;
}
?>
<!DOCTYPE html>

<head>
</head>

<body>
    <?php
    if (isset($_COOKIE["Edvin"])) {
        session_name("Edvin");
        session_start();
        echo "Site used = ", $_SESSION['counter'];
    ?>
        <form action="exists.php" method="POST" id="data">
            <input type="submit" name="resetter" value="Reset">
        </form>
    <?php
    } else echo "No valid sessions found!";
    ?>
    <a href='./index.php'>Back to log in form</a>
</body>

</html>