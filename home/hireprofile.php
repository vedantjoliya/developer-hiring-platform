<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'vedant');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'developer') {
    header("Location: ../dev/hiresign.html");
    exit;
}

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);

    $sql = "SELECT user_id, fullname, email, phnum, hours, company, country, desig, skill, work FROM hire WHERE user_id = ?";
    $stmt = $mysqli->prepare($sql);

    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No profile found.";
        exit();
    }

    $stmt->close();
} else {
    echo "Invalid request.";
    exit();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['fullname']); ?>'s Profile</title>
    <link rel="stylesheet" href="hirestyle.css">
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
            Profile of <?php echo htmlspecialchars($row['fullname']); ?>
        </div>


        <div class="profile-container">
            <div class="proimg">
                <img src="../Assets/business-profile.png" alt="Profile Image" class="profile-img">
            </div>
            <div class="protxt">
                <h1><?php echo htmlspecialchars($row['fullname']); ?></h1>
                <h2><?php echo htmlspecialchars($row['desig']); ?></h2>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($row['phnum']); ?></p>
                <p><strong>Company:</strong> <?php echo htmlspecialchars($row['company']); ?></p>
                <p><strong>Hours Available:</strong> <?php echo htmlspecialchars($row['hours']); ?></p>
                <p><strong>Country:</strong> <?php echo htmlspecialchars($row['country']); ?></p>
                <p><strong>Skills:</strong> <?php echo htmlspecialchars($row['skill']); ?></p>
                <p><strong>Work Description:</strong> <?php echo htmlspecialchars($row['work']); ?></p>
            </div>
        </div>

        <div class="backto">
            <a href="./devhome.php">
                <-- Check out others</a>
        </div>
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

            <div class="send">
                <form action="../sub/sub.php" method="post">
                    <input type="email" class="emaill" name="email" placeholder="Enter Your Email" required>

                    <button type="submit" id="subss" class="btn">Subscribe</button>

                </form>
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