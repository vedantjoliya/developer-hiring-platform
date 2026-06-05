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


$searchResults = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchQuery = mysqli_real_escape_string($mysqli, $_POST['search']);

    $sql = "SELECT * FROM hire WHERE 
            fullname LIKE '%$searchQuery%' OR 
            desig LIKE '%$searchQuery%' OR 
            skill LIKE '%$searchQuery%' OR 
          
            work LIKE '%$searchQuery%'";

    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
        }
    } else {
        echo '<script type="text/javascript">alert("No results found.");</script>';
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Profiles</title>
    <link rel="stylesheet" href="devstyle.css">
    <style>
        .form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .submit {
            background-color: #F9F6EE;
            border: 3px solid #796797;
            color: #424f57;
            width: 250px;
            padding: 10px 20px;
            height: 50px;
            font-size: large;
            box-shadow: 7px 7px 0px #796797;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.9s;
            transition: all 0.7s;
        }

        .submit:hover {
            color: #F9F6EE;
            background-color: #796797;
            box-shadow: 8px 8px 0px #F9F6EE;
        }

        .longg {
            background-color: #F9F6EE;
            border: 3px solid #796797;
            padding-left: 15px;
            margin-top: 3%;
            width: 450px;
            height: 50px;
            box-shadow: 5px 5px 0px #796797;
        }
    </style>
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
            Search Hirings
        </div>

        <div class="developers-container">
            <?php
            if (!empty($searchResults)) {
                foreach ($searchResults as $row) {
                    ?>
                    <article class="developer-card" id="developer-<?php echo htmlspecialchars($row['user_id']); ?>">
                        <h2><?php echo htmlspecialchars($row['fullname']); ?></h2>
                        <h3>Company: <?php echo htmlspecialchars($row['company']); ?></h3>
                        <p><strong><?php echo htmlspecialchars($row['desig']); ?></p>
                        <p><strong>Hours:</strong> <?php echo htmlspecialchars($row['hours']); ?></p>
                        <p><strong>Skills:</strong> <?php echo htmlspecialchars($row['skill']); ?></p>


                        <button class="request-connection-btn"
                            data-requester-id="<?php echo htmlspecialchars($row['user_id']); ?>">
                            Request Connection
                        </button>
                    </article>
                    <?php
                }
            }
            ?>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.request-connection-btn');

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.getAttribute('data-requester-id');
                    window.location.href = `./hireprofile.php?id=${userId}`;
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