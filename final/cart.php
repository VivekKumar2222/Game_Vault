<?php
include "conn.php";

// Start the session at the beginning
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Handle logout logic
if (isset($_GET['log']) && $_GET['log'] === 'true') {
    session_destroy();
    header("Location: home.php"); // Redirect to the home page after logout
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <!-- Navbar starts -->
    <div class="nav-wrapper-self">
        <div class="logo_img">
            <img src="image/GV_logo-02.png" alt="">
        </div>
        <nav class="navbar navbar-expand">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-0">
                        <li class="nav-item">
                            <button id="side_bar_toggle" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">Menu</button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Collection</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="game_category_page.php?category=action">Action</a></li>
                                <li><a class="dropdown-item" href="game_category_page.php?category=adventure">Adventure</a></li>
                                <li><a class="dropdown-item" href="game_category_page.php?category=horror">Horror</a></li>
                                <li><a class="dropdown-item" href="game_category_page.php?category=shooting">Shooting</a></li>
                                <li><a class="dropdown-item" href="game_category_page.php?category=sports">Sports</a></li>
                                <li><a class="dropdown-item" href="game_category_page.php?category=educational">Educational</a></li>
                                <li><a class="dropdown-item" href="game_category_page.php?category=rpg">RPG</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">More Coming Soon</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                        <?php
                        if (isset($_SESSION["userID"])){
                        $userID = $_SESSION["userID"];
                        
                        $cart_check = "SELECT * FROM carts WHERE UserID = '$userID'";
                        $cart_check_result = mysqli_query($conn, $cart_check);

                        $cart_count = mysqli_num_rows($cart_check_result);
                        if ($_SESSION["login_status"] == TRUE) {
                            if ($cart_count == 0) {
                                echo '<a class="nav-link" href="cart.php">Cart<span class="badge text-bg-info ms-2"></span></a>';
                            } elseif ($cart_count > 0) {
                                echo '<a class="nav-link" href="cart.php">Cart<span class="badge text-bg-info ms-2">' . $cart_count . '</span></a>';
                            }
                        } else {
                            echo '<a class="nav-link" href="cart.php">Cart</a>';
                        }
                    }
                        ?>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <?php
                        if ($_SESSION["login_status"] == true) {
                            echo '<a href="?log=true" id="login_nav" class="btn btn-outline-success" type="submit">LogOut</a>';
                        } else {
                            echo '<a id="signin_nav" href="sign_index.php" class="btn btn-outline-success" type="submit">SignIn</a>';
                            echo '<a id="login_nav" href="login_index.php" class="btn btn-outline-success" type="submit">LogIn</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
        <div class="logo_img">
        </div>
    </div>

    <!-- Sidebar (Offcanvas) -->
    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Navbar ends -->
    <br><br>

    <?php
    // Check if user is logged in
    if (!isset($_SESSION['login_status']) || !$_SESSION['login_status']) {
        echo '<div class="message_space">
            <p class="error_message">You are not Logged in !! Login First</p>
            <a class="go_back" href="home.php">Go Back</a>
        </div>';
        exit(); // Stop further execution
    }

    include 'conn.php';

    if (isset($_GET['action']) && $_GET['action'] === 'delete') {
        $id = $_GET['id'];
        // Perform delete action with $id
        $del_query = "DELETE FROM `carts` WHERE ItemID = '$id'";
        $del_result = mysqli_query($conn, $del_query);
    }

    $userID = $_SESSION["userID"];
    $sql_query = "SELECT * FROM `carts` WHERE UserID = '$userID'";
    $result = mysqli_query($conn, $sql_query);
    ?>


    
    <?php
    if ($result) {
        if (mysqli_num_rows($result) > 0) { // Check if the cart has items

            echo '<div class="checkout_all_space" style="width: 100%; display: flex; justify-content: center">
    <div class="checkout_all_wrapper" style="width: 1437px; display: flex; justify-content: flex-end;">
<a href="multiplecheckout.php" class="btn btn-info mb-3" style="width: 200px; background-color: #26BBFF;">CheckOut ALL</a>
</div>
</div>';
            while ($row = mysqli_fetch_assoc($result)) { // Fetch each item
                $item_name = $row['ItemName'];
                $item_ID = $row['ItemID'];
                $item_desc = $row['ItemDescription'];
                $item_price = $row['ItemPrice'];

                // Fetch the image for the item from another table
                $game_sql_query = "SELECT * FROM `game` WHERE ID = '$item_ID'";
                $game_result = mysqli_query($conn, $game_sql_query);

                if ($game_result && mysqli_num_rows($game_result) > 0) {
                    $img_row = mysqli_fetch_assoc($game_result);
                    $img = $img_row['Cover_Image'];
                } else {
                    $img = 'default_image.png'; // Fallback image if no image is found
                }

                

                // Display the cart item
                echo '<div class="cart_self_space">
                    <div class="cart_self_wrapper">
                        <div class="cart_left">
                            <div class="cart_item_img">
                                <img src="image/' . $img . '" alt="">
                            </div>
                            <div class="cart_item_desc">
                                <h1 class="title">' . $item_name . '</h1>
                                <p class="price">$' . $item_price . '</p>
                                <p class="desc">' . $item_desc . '</p>
                            </div>
                        </div>
                        <div class="cart_right">
                            <a href="cart.php?action=delete&id=' . $item_ID . '" class="del_button">Remove</a>
                            <a href="checkout.php?id=' . $item_ID . '" class="checkout_button">CheckOut</a>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<div class="message_space">
                <img class="mess_img" src="image/cartEmpty.png" alt="">
                <p class="error_message">No items in the cart</p>
            </div>';
        }
    } else {
        echo '<p class="error_message">Error fetching cart items</p>';
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
