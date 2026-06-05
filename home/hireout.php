<!DOCTYPE html>
<html>

<head>
    <title>Logout</title>

    <link rel="icon" type="images/x-icon" href="../logo/logo.png" />


</head>

<body>

    <?php
    session_start();

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

        $_SESSION = array();

        session_destroy();

        header("Location: ../dev/hiresign.html");
    } else {
        echo '<h1>You are not logged in. No action required.</h1>';
    }
    ?>

    <p><a href="../dev/hiresign.html">Log In</a></p>

</body>

</html>