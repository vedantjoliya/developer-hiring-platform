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
$hours = mysqli_real_escape_string($c, $_POST["hours"]);
$company = mysqli_real_escape_string($c, $_POST["company"]);
$country = mysqli_real_escape_string($c, $_POST["country"]);
$desig = mysqli_real_escape_string($c, $_POST["desig"]);
$skill = mysqli_real_escape_string($c, $_POST["skill"]);
$work = mysqli_real_escape_string($c, $_POST["work"]);

$q = "INSERT INTO `hire`(`fullname`, `email`, `phnum`, `password`, `hours`, `company`, `country`, `desig`, `skill`, `work`) 
      VALUES ('$fullname', '$email', '$phnum', '$password', '$hours', '$company', '$country', '$desig', '$skill', '$work')";
$insert = mysqli_query($c, $q);

if ($insert) {
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = mysqli_insert_id($c); // Get the last inserted ID
    $_SESSION['email'] = $email;
    $_SESSION['role'] = 'recruiter';

    header("Location: ../home/hirehome.php");
    exit;
} else {
    echo '<script type="text/javascript">alert("ERROR IN INSERTING: ' . mysqli_error($c) . '");</script>';
}

mysqli_close($c);
?>