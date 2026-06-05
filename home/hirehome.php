<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'vedant');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
if (
    !isset($_SESSION['logged_in']) || !isset($_SESSION['role']) ||
    $_SESSION['role'] !== 'recruiter'
) {
    header("Location: ../dev/hiresign.html");

    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Hiring</title>
    <link rel="stylesheet" href="hirestyle.css">
</head>

<body>
    <div class="header">
        <img class="logo" src="../Assets/logo.png" alt="Logo">
        <div class="menu">
            <div><a href="./hirehome.php" class="menu-item">Browse
                    Developers</a></div>
            <div><a href="./hiresearch.html" class="menu-item">Search</a></div>
            <div><a href="./hireedit.php" class="menu-item">Profile</a></div>

        </div>
        <div class="right-side">
            <div>
                <a class="btn" href="./hireout.php">Sign Out</a>
            </div>
        </div>
    </div>

    <div class="section1">
        <div class="heading">
            Hire Top Developers
        </div>
        <div class="heading2">
            Choose from the best software developers to tackle your tech challenges.
        </div>
    </div>

    <div class="developers-container">
        <?php
        $sql = "SELECT user_id, fullname, desig, price, skill FROM dev";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
        <article class="developer-card" id="developer-<?php echo $row['user_id']; ?>">
            <img src="../Assets/user-folder.png" alt=img" class="developer-img">
            <h2><?php echo $row['fullname']; ?></h2>
            <h3><?php echo $row['desig']; ?></h3>
            <p><?php echo $row['skill']; ?></p>
            <button class="hire-btn" data-developer-id="<?php echo $row['user_id']; ?>">
                Hire now ₹<?php echo $row['price']; ?>/h
            </button>
        </article>
        <?php
            }
        } else {
            echo "0 results";
        }

        $mysqli->close();
        ?>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.hire-btn');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-developer-id');
                window.location.href = `./devprofile.php?id=${userId}`;
            });
        });
    });
    </script>


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