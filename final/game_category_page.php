<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Category</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">  
</head>
  <body>
    
    <?php
    include 'conn.php';
    session_start();

if (!isset($_SESSION["login_status"])) {
    $_SESSION["login_status"] = FALSE; 
}

$category_get = $_GET['category'];
$cap_category_get = ucfirst($category_get);
    ?>

<!-- nav bar starts -->
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
                        <a class="nav-link"  aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="active_link_nav" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Collection</a>
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
                    if ($_SESSION["login_status"] == TRUE) {
                        echo '<a href="?log=true" id="login_nav" class="btn btn-outline-success" type="submit">LogOut</a>';
                        if (isset($_GET['log'])) {
                            session_destroy();
                        }
                    } else {
                        echo '<a id="signin_nav" href="sign_index.php" class="btn btn-outline-success" type="submit">SignIn</a>';
                        echo '<a id="login_nav" href="login_index.php" class="btn btn-outline-success" type="submit">LogIn</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="search_self">
        <form class="d-flex" role="search" action="search.php" method="GET">
            <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
       </form>
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
<!-- nav bar ends -->


<?php
    echo '<h1 class="game_category_title">'. $cap_category_get .' Games</h1>';
    ?>
    <div class="card_self_space">
    <div class="card_self_wrapper">
    <?php
    

    $sql_show = "SELECT * FROM game WHERE Category LIKE '%$category_get%'";

    $result = mysqli_query($conn, $sql_show);
    

    if($result){
        $game_count = mysqli_num_rows($result);
        if($game_count > 0){
        while($row = mysqli_fetch_assoc($result)){

            $id = $row['ID'];
        $name = $row['Name'];
        $price = $row['Price'];
        $cdesc = $row['Description'];
        $coverimage = $row['Cover_Image'];
        $discount = $row['Discount'];
        $discount_amount = ($price * $discount) / 100;
        $updated_price = $price - $discount_amount;



          echo '<a class="card_self" href="purchase-i.php?id= '. $id .'">';
          echo '<div class="img_div">';
          echo '<img src="image/' . $coverimage . '" alt="">';
          echo '</div>';
          echo '<div class="text">';
          echo '<p class="name_self">' . $name . '</p>';
          echo '<p class="price_self">';
          echo '<span>$' . $updated_price . '</span> '; // Price text
          if($discount > 0){
          echo '<span class="badge bg-primary" style="background-color: #26BBFF">' . '-' . $discount . '%' . '</span>'; // Badge text
          }
          echo '</p>';
          echo '</div>';
          echo '</a>';
        }
    }
    else{
        echo '
        <div class="error_message_container">
        <p class="error_message">Nothing to Show Currently</p>
        </div>';
    }
    }
    ?>
    </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>

</html>