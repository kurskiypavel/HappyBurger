<?php
// Connection with DB
require_once 'config.php';

// Initialize the session
session_start();
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id='$user_id'";
$result = $mysqli->query($query);

if (!$result) {
    die($mysqli->connect_error);
}
$rows = $result->num_rows;

for ($i = 0; $i < $rows; ++$i) {
    $result->data_seek($i);
    $obj = $result->fetch_object();
    $bdate = $obj->bdate;
    $gender = $obj->gender;
    $phone = $obj->phone;
    $notify = $obj->notify;
    $registered_at = $obj->created_at;
    $user_img = $obj->user_img;
}
?>

<!--upload new avatar image and render on the page-->
<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload"])) {
    //image directory var
    $img_dir = "images/users/";
//    validate if uploaded file is .png or .jpg image
    $file_extention = pathinfo($filename);
    if ($file_extention["extension"] == "jpg" || $file_extention["extension"] == "png"){
        //prepare for renaming uploaded file before saving
        $temp = explode(".", $_FILES["filename"]["name"]);
        //save uploaded image under user's id on server
        $newfilename = $user_id . '.' . end($temp);
        //move to server
        move_uploaded_file($_FILES["filename"]["tmp_name"], $img_dir . $newfilename);
        //send to DB
        $sql_new_avatar = "UPDATE users SET user_img = '$newfilename' WHERE id='$user_id'";
        $mysqli->query($sql_new_avatar);
        echo "<meta http-equiv='refresh' content='0'>";
    } else{
        $image_err = "Please use .png or .jpg format.";
    }

}
?>

<!--Update personal information if Save pressed on Page:users.php Field:personal information-->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save"])) {


    // validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            // set parameters
            $param_username = trim($_POST["username"]);

            // attempt to execute the prepared statement
            if ($stmt->execute()) {
                // store result
                $stmt->store_result();

                if ($stmt->num_rows == 1 && $param_username != $username) {
                    $username_err = "This username is already taken.";
                } else {
                    $newUsername = trim($_POST["username"]);
                }
            }
        }
        // close statement
        $stmt->close();
    }


//get all current values from form
    $datePosted = $_POST['birthdate'];
    $time = strtotime($datePosted);
    $bdate = date('Y-m-d', $time);
    $phone = trim($_POST['phone']);

    if ($_POST['gender'] == 'male') {
        $newGender = true;
    } elseif ($_POST['gender'] == 'female') {
        $newGender = false;
    }

    if ($_POST['notify'] == true) {
        $notify = true;
    } elseif ($_POST['notify'] == false) {
        $notify = false;
    }

//set to the query new values and update
    if (!$username_err) {
        $sql_new_info = "UPDATE users SET username='$newUsername',
                                      bdate='$bdate',
                                      phone='$phone',
                                      gender='$newGender',
                                      notify='$notify'
                                      WHERE id='$user_id'";

        //update username for current session
        echo "<meta http-equiv='refresh' content='0'>";
        $_SESSION['username'] = $newUsername;
        $mysqli->query($sql_new_info);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <?php require_once "head_sources.php" ?>
</head>

<body>
<?php
//if !username show login page
if (!$username) {
    header("location: login.php");
    exit;
}
?>
<div class="container">
    <?php require_once "header.php" ?>
    <div class="row profileRow">
        <div class="col s12">
            <!--User name-->
            <div class="col s6">
                <h4 class="current_username">Howdy <?php echo $username ?>!</h4>
                <!--show avatar-->
                <?php
                $user_avatar = "images/users/" . $user_img;
                //                if image is not set
                if (empty($user_img)) {
                    //show icon
                    echo '<i class="material-icons prefix" id="avatar">face</i>';
                } else {
                    //else show from DB record
                    echo '<img id="avatar" src="images/users/' . $user_img . '"/>';
                }
                ?>

<!--                <form method='post' action='user.php' enctype='multipart/form-data'>-->
                <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' enctype='multipart/form-data'>
                    <div class="file-field input-field">
                        <div class="btn">
                            <!--upload new image to the server-->
                            <span>Change image</span>
                            <input id="changeImage" type='file' name='filename' size='1' accept="image/png,image/jpeg ">
                        </div>
                        <div class="file-path-wrapper col s6">
                            <input class="file-path validate" type="text" placeholder=".png, .jpg">
                        </div>

                    </div>

                    <!--if user has pick image show upload button-->
                    <div class="row" id="upload">
                        <div class="col s12">
                            <div class="col s6 left-align">
                                <input class="teal lighten-1 btn" type='submit' name="upload" value="upload">
                            </div>
                            <div class="col s6 left-align">
                                <button class="waves-effect waves-light btn red darken-1" id="cancel" type="submit">
                                    <a>cancel</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <span class="help-block col s6"><?php echo $image_err; ?></span>
            </div>
            <div class="col s6  z-depth-1">
                <h5>Personal Information</h5>
                <form id="personalInfoForm" class="col s12" method="post">
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="icon_prefix" type="text" class="validate" name="username"
                                   value="<?php echo $username ?>">
                            <span class="help-block"><?php echo $username_err; ?></span>
                            <!--                            show current user name from session-->
                            <label for="icon_prefix">User Name</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">phone</i>
                            <input id="icon_telephone" type="tel" pattern='[\+]\d{1}[\(]\d{3}[\)]\d{3}[\-]\d{4}'
                                   placeholder="+1(234)567-8910" name="phone"
                                   value="<?php echo $phone ?>">
                            <!--                            show current telephone-->
                            <label for="icon_telephone">Telephone</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <label for="gender" class="active">Gender</label>

                            <div>
                                <p>
                                    <label>
                                        <input id="male" name="gender"
                                               type="radio" <?php if ($gender == true && !is_null($gender)) {
                                            echo "checked ";
                                            echo 'value="male"';
                                        } ?>
                                        />
                                        <span>Male</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input id="female" name="gender"
                                               type="radio" <?php if ($gender != true && !is_null($gender)) {
                                            echo "checked ";
                                            echo 'value="female"';
                                        } ?>/>
                                        <span>Female</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                        <div class="col s5">
                            <!--                            show birthdate from db-->
                            <label for="birthdate">Birthdate</label>
                            <input type="text" class="datepicker" name="birthdate">
                        </div>
                    </div>
                    <div class="col s12 center-align notifications">
                        <p>Notify by email about new products</p>
                        <!--            show notif preferences-->
                        <div class="switch">
                            <label>
                                Off
                                <input id="notify" type="checkbox" name="notify" <?php if ($notify == true) {
                                    echo "checked";
                                } ?>>
                                <span class="lever"></span>
                                On
                            </label>
                        </div>
                    </div>
                    <div class="" id="updateInfo">
                        <div class="col s12">
                            <div class="col s6 right-align">
                                <button class="waves-effect waves-light btn" type="submit" name="save">
                                    save
                                </button>
                            </div>

                            <div class="col s6 left-align">
                                <button class="waves-effect waves-light btn red darken-1" id="cancel1" type="submit">
                                    <a>cancel</a>
                                </button>
                            </div>
                        </div>
                    </div>
            </div>

            </form>

        </div>
    </div>
    <div class="col s12 center-align" id="loyalFrom">
        <!--            show registration date-->
        <p class="registeredAt"></p>
    </div>
</div>
</div>
</div>

<?php require_once "bottom_sources.php" ?>

<script>
    //Format registration date output
    //grab registration date
    var created_at = "<?php echo $registered_at ?>";
    //format rules
    var momentV = moment(created_at, "YYYYMMDD").format("MMMM Do, YYYY");
    //output the result on page
    document.querySelector(".registeredAt").innerHTML = "You are our Loyal Customer since " + momentV;

    //Format birthdate date output
    //grab birthday date
    var birthday = "<?php echo $bdate ?>";
    if (birthday) {
        //format rules
        var momentBirth = moment(birthday, "YYYYMMDD").format("MMM DD, YYYY");
        //output the result on page
        document.querySelector("input[name='birthdate']").value = momentBirth;
    }
</script>

<!-- close connection -->
<?php $mysqli->close(); ?>
</body>

</html>