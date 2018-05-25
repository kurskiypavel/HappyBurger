<?php
// Connection with DB
require_once 'config.php';

// Initialize the session
session_start();
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <?php require_once "head_sources.php"?>
</head>

<body>
<div class="container">
    <?php require_once "header.php"?>
    <div class="row">
        <?php
        $query = "SELECT * FROM products";
        $result = $mysqli->query($query);
        if (!$result) die($mysqli->connect_error);
        $rows = $result->num_rows;

        for ($i = 0; $i < $rows; ++$i) {
            $result->data_seek($i);
            $obj = $result->fetch_object();
            echo '<div class="col s6"> <a href="product.php?id='.$obj->id.'"><h4>' . $obj->product_name . '</h4></a><br>';
            echo '<a href="product.php?id='.$obj->id.'"><img class="productPic" src="images/products/' . $obj->product_img_name . '"/></a>';
            echo '<p><b>Description: </b>' . $obj->product_desc . '</p>';
            echo '<p>Product Price: <span id="price">' . $obj->price . ' CAD</span></p>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<?php require_once "bottom_sources.php"?>

<!-- close connection -->
<?php $mysqli->close(); ?>

</body>

</html>