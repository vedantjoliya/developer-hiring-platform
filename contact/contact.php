<?php
$c = mysqli_connect('localhost', 'root', '', 'vedant');

if (!$c) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $phnum = $_POST['phnum'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    $sql = "INSERT INTO contact_us (fullname, email, phnum, subject, message) VALUES ('$fullname', '$email', '$phnum', '$subject', '$message')";

    if ($c->query($sql) === TRUE) {
        echo '<script type="text/javascript">
                alert("We will contact you shortly...");
                window.location.href = "../index/index.html";
              </script>';
    } else {
        echo '<script type="text/javascript">
                alert("Submit details properly !!");
                window.location.href = "../contact/contact.html";
              </script>';
    }

    $c->close();
}
?>