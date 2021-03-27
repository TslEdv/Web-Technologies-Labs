<!DOCTYPE html>

<head>
</head>

<body>
    <form action="login.php" method="POST" id="formdata">
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" placeholder="First Name" pattern="[A-Za-z-.]+" required><br>
        <input type="submit" value="Log in" name="submit">
        <p>Check if a session exists!: <a href="./exists.php">check</a></p>
        <a href="cookies.php">Task 1 with cookies</a>
    </form>
</body>

</html>