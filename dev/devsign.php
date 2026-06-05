<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'vedant');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($mysqli, $_POST["email"]);
    $password = mysqli_real_escape_string($mysqli, $_POST["password"]);

    $sql = "SELECT user_id FROM `dev` WHERE email = '$email' AND password = '$password'";
    $result = $mysqli->query($sql);

    if ($result && $result->num_rows == 1) {

        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];

        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = 'developer';
        header("Location: ../home/devhome.php");
        exit;
    } else {
        echo '<script type="text/javascript">alert("Invalid email or password.");</script>';
    }
}

$mysqli->close();
?><?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'vedant');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($mysqli, $_POST["email"]);
    $password = mysqli_real_escape_string($mysqli, $_POST["password"]);

    $sql = "SELECT user_id FROM `dev` WHERE email = '$email' AND password = '$password'";
    $result = $mysqli->query($sql);

    if ($result && $result->num_rows == 1) {

        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];

        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = 'developer';
        header("Location: ../home/devhome.php");
        exit;
    } else {
        echo '<script type="text/javascript">alert("Invalid email or password.");</script>';
    }
}

$mysqli->close();
?>