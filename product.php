<?php
// Connection with DB
require_once 'config.php';

// Initialize the session
session_start();
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

// Processing form data when form - review is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['review'])) {
    //check if user is logged in before posting
    if ($username) {
        $id = $_GET['id'];
        $review = htmlspecialchars($_POST['review']);
        $rating = $_POST['rating'];
        $created_at = date('Y-m-d H:i:s');
        $sql_new_review = "INSERT INTO reviews VALUES" . "(NULL, '$id', '$user_id', '$review', '$created_at','$rating')";
        $mysqli->query($sql_new_review);
    }
}


//  Delete review
if (isset($_POST['delete']) && isset($_POST['review_id'])) {
    $review_id = $_POST['review_id'];
    $sql_delete_review = "DELETE FROM reviews WHERE review_id='$review_id'";
//    get result of delete action
    $result = $mysqli->query($sql_delete_review);
    if (!$result) echo "DELETE failed: $sql_delete_review<br>" .
        $mysqli->error . "<br><br>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Work</title>
    <?php include_once "head_sources.php" ?>
</head>

<body>
<div class="container">
    <?php include_once "header.php" ?>
    <!--product content-->
    <div class="row">
        <?php
        $query = "SELECT * FROM products WHERE id='$id'";
        $result = $mysqli->query($query);
        if (!$result) die($mysqli->connect_error);
        $rows = $result->num_rows;
        $result->data_seek();
        $obj = $result->fetch_object();

        echo '<div class="col s12"><h4>' . $obj->product_name . '</h4></div>';
        echo '<div class="col s6"><img src="images/products/' . $obj->product_img_name . '"/>
            </div>';
        echo '<div class="col s6"><p><b>Description: </b>' . $obj->product_desc . '</p>';
        echo '<p>Product Price: <span id="price">' . $obj->price . ' CAD</span></p>';
        //            echo '<p>Product Quantity: ' . $obj->qty . '</p>';

        /*  getting the actual rating of the current product    */
        $sql_avg_result = "SELECT (sum(reviews.review_rating) / count(reviews.review_rating)) as avg_rating 
                                FROM reviews 
                                WHERE reviews.product_id = '$id' 
                                GROUP BY product_id";
        //var holds the avg_rating of the product based on the review ratings for this product
        $avg_result = $mysqli->query($sql_avg_result);

        if (!$avg_result) die($mysqli->connect_error);
        $rows = $avg_result->num_rows;

        for ($i = 0; $i < $rows; ++$i) {
            $avg_result->data_seek($i);
            $obj_rating = $avg_result->fetch_object();
            echo '<p>Reviews rating: ' . intval($obj_rating->avg_rating) . '%</p>';
        }

        /*  shopping cart add btn   */
        // check if user_id then run logic
        // else ask to login
        echo '<button class="btn-floating btn-large waves-effect waves-light red" type="submit" name="add_shopping_cart"><i class="material-icons">add_shopping_cart</i></button>';
        //if added show also remove_shopping_cart btn
        echo '</div>';
        ?>
    </div>

    <!--review form-->
    <div class="row">

        <form class="col s12" method="post" onsubmit='return validate()'>
            <?php
            if ($username) {
                echo '<p> Hey <b class="teal-text">' . $username . '</b>! Would you like to leave a review?</p>';
            } else {
                echo '<p> Hey! Would you like to leave a review?</p>';
            }
            ?>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix teal-text">mode_edit</i>
                    <textarea id="icon_prefix2" class="materialize-textarea textarea1 validate" name="review"></textarea>
                    <label for="icon_prefix2">How was your experience?</label>
                    <p class="range-field">
                        <i class="material-icons prefix teal-text">star</i>
                        <label for="rating">Rate the product!</label>
                        <input type="range" id="test5" min="0" max="100" name="rating"/>
                    </p>
                </div>
            </div>

            <!-- Modals Structure -->
            <!--user not logged in-->
            <div id="modal1" class="modal center-align">
                <div class="modal-content">
                    <h4>Uoppss...We don't know you :(</h4>
                    <p>Please, Log in or Sign Up to leave a review!</p>
                    <a href="login.php" class="modal-close waves-effect waves-teal btn-small center-align">Login</a>
                    <a href="register.php"
                       class="modal-close waves-effect waves-teal btn-small red darken-1 center-align">Sign Up</a>
                </div>
            </div>

                <?php if (!$username) {
                    echo <<<_END
            <!-- Modal Trigger -->
            <a class="waves-effect waves-light btn modal-trigger" href="#modal1">send
                <i class="material-icons right" > send</i>
            </a>
_END;
                } else {
                    echo <<<_END
            <!-- Submit new review btn -->
            <button class="btn waves-effect waves-light reviewBtn" type = "submit"
                    name = "new_review" > send
                <i class="material-icons right" > send</i>
            </button>
_END;
                } ?>


        </form>

    </div>
    <!--reviews list-->
    <div class="row">
        <div class="col s6">
            <ul class="collection">
                <?php
                $query = "SELECT *,reviews.created_at as review_date
                          FROM users INNER JOIN reviews ON (users.id = reviews.user_id) 
                          WHERE product_id='$id' 
                          ORDER BY reviews.created_at DESC ";
                $result = $mysqli->query($query);

                if (!$result) die($mysqli->connect_error);
                $rows = $result->num_rows;

                for ($i = 0; $i < $rows; ++$i) {
                    $result->data_seek($i);
                    $obj = $result->fetch_object();
                    echo '<li class="collection-item avatar">';

                    if (!empty($obj->user_img)) {
                        echo '<img src="images/users/' . $obj->user_img . '"class="circle"/>';
                    } else {
                        echo '<i class="material-icons prefix circle" id="avatar">face</i>';
                    }
                    echo '<span class="title">' . $obj->username . '</span><p>' . $obj->review_date . '</p>';
                    echo '<p>' . $obj->review . '</p>';
                    echo '<a href="" class="secondary-content">
                            <p>' . $obj->review_rating . '</p>';

                    if ($obj->review_rating > 50) {
                        echo '<i class="material-icons">star</i>';
                    } elseif ($obj->review_rating >= 30 && $obj->review_rating <= 50) {
                        echo '<i class="material-icons">star_half</i>';
                    } elseif ($obj->review_rating < 30 && !is_null($obj->review_rating)) {
                        echo '<i class="material-icons">star_border</i>';
                    };
                    echo '</a>';
                    // if author name = session username show delete button
                    if ($username == $obj->username) {
                        echo '<form method="post">                        
                         <button class="btn-small waves-effect waves-light reviewBtn" type="submit" name="delete">delete
                            <i class="material-icons right">delete</i>
                         </button>';
                        echo '<input type="hidden" name="review_id" value="' . $obj->review_id . '">';
                        echo '</form>';
                    }
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<?php require_once "bottom_sources.php" ?>

<!-- close connection -->
<?php $mysqli->close(); ?>
</body>

</html>