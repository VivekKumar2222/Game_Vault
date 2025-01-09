<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Holiday Sale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="tab_1_nav.css">
</head>
  <body>
    <!-- nav bar starts -->
    <?php
  include 'conn.php';
  session_start();
  ?>

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
                            $cart_check = "SELECT * FROM `carts`";
                            $cart_check_result = mysqli_query($conn, $cart_check);
                            $cart_count = mysqli_num_rows($cart_check_result);

                            if ($_SESSION["login_status"] == true) {
                                if ($cart_count == 0) {
                                    echo '<a id="active_link_nav" class="nav-link" href="cart.php">Cart<span class="badge text-bg-info ms-2"></span></a>';
                                } elseif ($cart_count > 0) {
                                    echo '<a id="active_link_nav" class="nav-link" href="cart.php">Cart<span class="badge text-bg-info ms-2">' . $cart_count . '</span></a>';
                                }
                            } else {
                                echo '<a id="active_link_nav" class="nav-link" href="cart.php">Cart</a>';
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

        <div class="start_space">
            <div class="start_self_wrapper">
                <div class="start_text">
                <h1>🎮 Holiday Game Sales Are Here! 🎉</h1>
                <p>Level up your holidays with jaw-dropping deals on the hottest games! 🕹️ Don't miss your chance to grab your favorites at unbeatable prices. The clock's ticking—get your game on today! ⏳🔥</p>

            </div>
                <div class="tab_self">
            <img src="image/holiday_tab_iimg.png" alt="">
                </div>
            </div>
        </div>
<div class="game_category_title_wrapper">
        <h1 class="game_category_title">Check Out amazing Deals</h1>
        </div>
    <div class="card_self_space">
      <!-- <div class="game_category_title_wrapper">
      <h1 class="game_category_title">All Games</h1>
      </div> -->
    <div class="card_self_wrapper">
    <?php
    

    $sql_show = "SELECT * FROM game WHERE Discount > 0";

    $result = mysqli_query($conn, $sql_show);

    if($result){
        
        while($row = mysqli_fetch_assoc($result)){

            $id = $row['ID'];
        $name = $row['Name'];
        $price = $row['Price'];
        $cdesc = $row['Description'];
        $coverimage = $row['Cover_Image'];
        $discount = $row['Discount'];
        $discount_amount = ($price * $discount) / 100;
        $updated_price = $price - $discount_amount;



          echo '<div class="card_self">';
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
          echo '</div>';
        }
    }
    ?>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>