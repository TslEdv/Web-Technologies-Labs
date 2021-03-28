<!DOCTYPE html>

<head>
</head>

<body>
    <?php
    if ($_POST['fname'] == "Edvin") {
        session_name("Edvin");
        session_start();
        $_SESSION['name'] = "Edvin Ess";
        $_SESSION['age'] = "19";
        $_SESSION['location'] = "Tallinn";
        $_SESSION['id'] = session_id();
        echo "Session ID = ", $_SESSION['id'], "<br>";
        echo "Welcome ", $_SESSION['name'], "! <br>";
        echo "Your age: ", $_SESSION['age'], "<br>";
        echo "Your location: ", $_SESSION['location'], "<br>";
        if (session_status() == PHP_SESSION_ACTIVE) {
            if (isset($_SESSION['counter'])) {
                $_SESSION['counter'] += 1;
            } else {
                $_SESSION['counter'] = 1;
            }
        }
        echo "Site refreshed = ", $_SESSION['counter'];
    ?>
        <form action="logout.php" method="POST" id="data">
            <input type="submit" value="Log out" name="logout">
        </form>
        <p>Check if a session exists!: <a href="./exists.php">check</a></p>
    <?php
    }else if (isset($_COOKIE["Edvin"])) {
        session_name("Edvin");
        session_start();
        $_SESSION['name'] = "Edvin Ess";
        $_SESSION['age'] = "19";
        $_SESSION['location'] = "Tallinn";
        $_SESSION['id'] = session_id();
        echo "Session ID = ", $_SESSION['id'], "<br>";
        echo "Welcome ", $_SESSION['name'], "! <br>";
        echo "Your age: ", $_SESSION['age'], "<br>";
        echo "Your location: ", $_SESSION['location'], "<br>";
        if (session_status() == PHP_SESSION_ACTIVE) {
            if (isset($_SESSION['counter'])) {
                $_SESSION['counter'] += 1;
            } else {
                $_SESSION['counter'] = 1;
            }
        }
        echo "Site refreshed = ", $_SESSION['counter'];
    ?>
        <form action="logout.php" method="POST" id="data">
            <input type="submit" value="Log out" name="logout">
        </form>
        <p>Check if a session exists!: <a href="./exists.php">check</a></p>
    <?php
    } else echo "Incorrect User! <br> <a href='./index.php'>Back to log in form</a>";
    ?>

</body>

</html>