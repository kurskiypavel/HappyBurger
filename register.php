<?php
// Connection with DB
require_once 'config.php';
// define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

                if ($stmt->num_rows == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            }
        }
        // close statement
        $stmt->close();
    }

    // validate password
    if (empty(trim($_POST['password']))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST['password']);
    }

    // validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = 'Please confirm password.';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if ($password != $confirm_password) {
            $confirm_password_err = 'Password did not match.';
        }
    }

    // check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        // prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_username, $param_password);
            // set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // attempt to execute the prepared statement
            if ($stmt->execute()) {
                //get new user id
                // prepare a select statement
                $sql = "SELECT id FROM users WHERE username = ?";

                if ($stmt = $mysqli->prepare($sql)) {
                    // bind variables to the prepared statement as parameters
                    $stmt->bind_param("s", $param_username);
                    // set parameters
                    $param_username = $username;

                    // attempt to execute the prepared statement
                    if ($stmt->execute()) {
                        // store result
                        $stmt->store_result();

                        // check if username exists, if yes then verify password
                        if ($stmt->num_rows == 1) {
                            // bind result variables
                            $stmt->bind_result($user_id);

                            if ($stmt->fetch()) {
                                $_SESSION['user_id'] = $user_id;
                            }
                        }
                    }
                }

                //check if session
                if (!$_SESSION['username']) {
                    //new session
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $user_id;
                }
                // redirect to home page
                header("location: index.php");
            }
        }
        // close statement
        $stmt->close();
    }

// close connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <?php require_once "head_sources.php"?>
</head>
<body>
<div class="container">
    <?php require_once "header.php" ?>
</div>
<div class="container">
    <div class="row">
        <div class="col s4"></div>
        <div class="col s4 userForm">
            <h2>Sign Up</h2>
            <p>Please fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control"
                           value="<?php echo $confirm_password; ?>">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn red darken-1" value="Reset">
                </div>
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
        </div>
        <div class="col s4"></div>
    </div>

    <?php require_once "bottom_sources.php"?>

</body>
</html>