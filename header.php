<header>
    <nav class="transparent z-depth-0">
        <div class="nav-wrapper">
            <a href="index.php" class="brand-logo">
                <img src="images/logo.png" alt="Logo">
            </a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <form autocomplete="off" id="no-submit">
                        <div class="input-field ">
                            <i class="material-icons prefix">search</i>
                            <input type="text" id="autocomplete-input"  autocomplete="false" class="autocomplete">
                            <label for="autocomplete-input">Search...</label>
                        </div>
                    </form>
                </li>
                <li>
                    <!--products-->
                    <a id="product" href="products.php">Products</a>
                </li>
                <li>
                    <a id="about" href="#">About</a>
                </li>
                <li>
                    <a id="blog" href="#">Blog</a>
                </li>

                <!-- if session exist show logout -->
                <?php if ($username) { ?>
                    <li>
                        <a id="logout" href="callbacks/logout.php">Log Out</a>
                    </li>
                    <li>
                        <a class="current_username" href="user.php"><?php echo $username ?></a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a id="login" href="login.php">SIGN IN</a>
                    </li>
                    <li>
                        <a id="signup" href="register.php">SIGN UP</a>
                    </li>
                <?php } ?>
                <li>
                    <a href="order.php">
                        <i class="material-icons" id="shoppingCart">shopping_cart</i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>