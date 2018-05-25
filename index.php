<?php
// Get session
session_start();
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HOME</title>
    <?php require_once "head_sources.php"?>
</head>

<body>
<div class="container">
    <?php require_once "header.php"?>
</div>
<!-- slider -->
<img src="images/main slider.png" alt="IMAGE GOES HERE">
<!-- main content -->
<div id="body">
    <div class="container">
        <div class="row">
            <div class="center-align col s12">
                <h5>Welcome To The Club</h5>
                <p>Super cool work for super cool dudes</p>
            </div>
            <!-- responsive related figures -->
            <div class="card-container">
                <figure class="col s5">
                    <div class="subFigure">
                        <img src="images/img 1.png" alt="">
                        <figcaption>
                            Web development and AI algorithms
                        </figcaption>
                    </div>
                    <div class="subFigure">
                        <img src="images/img 3.png" alt="">
                        <figcaption>
                            Content writting
                        </figcaption>
                    </div>
                </figure>
                <figure class="col s7">
                    <img src="images/img 2.png" alt="">
                    <figcaption>
                        <ul>
                            <li>Mobile Application Development</li>
                            <li>Brand Identity</li>
                            <li>Social Media Integration</li>
                            <li>Newsletter Design</li>
                            <li>Booklets Design</li>
                        </ul>
                    </figcaption>
                </figure>
            </div>
        </div>
        <div class="center-align">
            <a href="products.php" class="waves-effect waves-light btn transparent z-depth-0">See More</a>
        </div>
        <footer>
            <a href="#"><img src="images/links.png " alt=""></a>
        </footer>
    </div>
</div>

<?php require_once "bottom_sources.php"?>

</body>

</html>



