<?php
session_start();

$c = mysqli_connect('localhost', 'root', '', 'vedant');

if (!$c) {
    die("Connection failed: " . mysqli_connect_error());
}

$fullname = mysqli_real_escape_string($c, $_POST["fullname"]);
$email = mysqli_real_escape_string($c, $_POST["email"]);
$phnum = mysqli_real_escape_string($c, $_POST["phnum"]);
$password = mysqli_real_escape_string($c, $_POST["password"]);
$price = mysqli_real_escape_string($c, $_POST["price"]);
$exp = mysqli_real_escape_string($c, $_POST["exp"]);
$country = mysqli_real_escape_string($c, $_POST["country"]);
$desig = mysqli_real_escape_string($c, $_POST["desig"]);
$linkedin = mysqli_real_escape_string($c, $_POST["linkedin"]);
$skill = mysqli_real_escape_string($c, $_POST["skill"]);
$work = mysqli_real_escape_string($c, $_POST["work"]);


$q = "INSERT INTO `dev`(`fullname`, `email`, `phnum`, `password`, `price`, `exp`, `country`, `desig`, `linkedin`, `skill`, `work`) 
      VALUES ('$fullname', '$email', '$phnum', '$password', '$price', '$exp', '$country', '$desig', '$linkedin', '$skill', '$work')";
$insert = mysqli_query($c, $q);

if ($insert) {

    $user_id = mysqli_insert_id($c);

    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['email'] = $email;
    $_SESSION['role'] = 'developer';

    header("Location: ../home/devhome.php");
    exit;
} else {
    echo '<script type="text/javascript">alert("ERROR IN INSERTING: ' . mysqli_error($c) . '");</script>';
}

mysqli_close($c);
?>