<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'vedant');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'developer') {
    header("Location: ../dev/devsign.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Hiring</title>
    <link rel="stylesheet" href="devstyle.css">
</head>

<body>
    <div class="header">
        <img class="logo" src="../Assets/logo.png" alt="Logo">
        <div class="menu">
            <div><a href="./devhome.php" class="menu-item">Browse Hirings</a></div>
            <div><a href="./devsearch.html" class="menu-item">Search</a></div>
            <div><a href="./devedit.php" class="menu-item">Profile</a></div>
        </div>
        <div class="right-side">
            <div>
                <a class="btn" href="./devout.php">Sign Out</a>
            </div>
        </div>
    </div>
    <div class="section1">
        <div class="heading">
            You Signed with <?php echo $_SESSION['email']; ?>
        </div>







        <div class="footer">

            <div class="left">
                <img class="white" src="../Assets/white.png" />

                <div class="sub">
                    <h3>Quick links</h3>
                    <div class="menu">
                        <div><a href="./index/index.html" class="menu-item">Home</a></div>
                        <div><a href="../works/works.html" class="menu-item">How
                                it
                                works</a></div>
                        <div><a href="../contact/contact.html" class="menu-item">Contact</a></div>
                        <div><a href="../about/about.html" class="menu-item">About us</a></div>
                        <div><a href="../sitemap/sitemap.html" class="menu-item">Site Map</a></div>
                    </div>
                </div>
            </div>
            <div class="right">

                <div class="menu">

                    <div class="send">
                        <form action="../sub/sub.php" method="post">
                            <input type="email" class="emaill" name="email" placeholder="Enter Your Email" required>
                            <div>
                                <button type="submit" id="subss" class="btn">Subscribe</button>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="icons">

                    <a href="https://www.instagram.com/uix.vedant/"><img src="../Assets/00 (1).png">
                    </a>
                    <a href="https://www.linkedin.com/in/vedant-joliya"><img id="linkk" src="../Assets/00 (2).png">
                    </a>
                    <a href="https://www.behance.net/vedantjoliya"><img src="../Assets/00 (3).png">
                    </a>

                </div>
                <div class="contact">
                    <div class="cons">
                        <img src="../Assets/mobile.png">
                        <a href="tel:+918511482248" class="menu-item">+91
                            8511482248</a>
                    </div>
                    <div class="cons">
                        <img src="../Assets/mail.png">
                        <a href=mailto:“contactsvedant@gmail.com” class="menu-item">contactsvedant@gmail.com</a>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>