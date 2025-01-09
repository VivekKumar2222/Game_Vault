<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
include 'conn.php'; // Ensure the database connection is included.
session_start();
// session_destroy();

// Initialize the session variable only if it isn't set
if (!isset($_SESSION["login_status"])) {
    $_SESSION["login_status"] = FALSE; // Default value
}
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
                        <a class="nav-link" id="active_link_nav" aria-current="page" href="home.php">Home</a>
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


<!-- tab starts -->
<div class="tab_self_space">
    <div class="tab_self_wrapper">
        <a href="tab_1_nav.php" class="tab_self">
            <img src="image/holiday_tab_iimg.png" alt="">
        </a>
        <a href="purchase-i.php?id=16" class="tab_self">
            <img src="image/tab_2_Iimg.png" alt="">
        </a>
        <a href="purchase-i.php?id=7" class="tab_self">
            <img src="image/tab_3_img.png" alt="">
        </a>
    </div>
</div>
<!-- tab ends -->


<!-- c starts -->

<div id="carouse_container" class="container">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <?php
            $counter = 0;
            $sql_show = "SELECT * FROM game WHERE ID IN (2, 3, 5)";
            $result = mysqli_query($conn, $sql_show);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['ID'];
                    $name = $row['Name'];
                    $price = $row['Price'];
                    $cdesc = $row['Description'];
                    $logo = $row['Logo'];
                    $keyart = $row['Key_Art'];
                    $discount = $row['Discount'];
                    $discount_amount = ($price * $discount) / 100;
                    $updated_price = $price - $discount_amount;

                    $activeClass = ($counter === 0) ? 'active' : ''; // Ensure the first item is active
                    echo '<div class="carousel-item ' . $activeClass . '">';
                    echo '<img src="image/' . $keyart . '" class="d-block w-100" alt="...">';
                    echo '<div class="carousel-caption d-none d-md-block">';
                    echo '<img src="image/' . $logo . '" alt="Slide Title 1" class="caros-logo-img">';
                    echo '<p class="caros-desc">' . $cdesc . '</p>';
                    echo '<a href="purchase-i.php?id=' . $id . '" class="btn btn-primary">Get It</a>';
                    echo '</div>';
                    echo '</div>';
                    $counter++;
                }
            }
            ?>

        </div>
    </div>
</div>

<!-- card scroll starts -->

<h1 class="game_category_title">Recommended Games</h1>
<div class="card_self_space_scroll">
    <div class="card_self_wrapper">

        <?php
        $sql_show = "SELECT * FROM game";
        $result = mysqli_query($conn, $sql_show);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['ID'];
                $name = $row['Name'];
                $price = $row['Price'];
                $cdesc = $row['Description'];
                $coverimage = $row['Cover_Image'];
                $discount = $row['Discount'];
                $discount_amount = ($price * $discount) / 100;
                $updated_price = $price - $discount_amount;

                echo '<a class="card_self" href="purchase-i.php?id=' . $id . '">';
                echo '<div class="img_div"><img src="image/' . $coverimage . '" alt=""></div>';
                echo '<div class="text">';
                echo '<p class="name_self">' . $name . '</p>';
                echo '<p class="price_self">';
                echo '<span>$' . $updated_price . '</span>'; // Price text
                if ($discount > 0) {
                    echo '<span class="badge bg-primary" style="background-color: #26BBFF">-' . $discount . '%</span>'; // Badge text
                }
                echo '</p>';
                echo '</div>';
                echo '</a>';
            }
        }
        ?>

    </div>
</div>

<h1 class="game_category_title">Action Games</h1>
<div class="card_self_space_scroll">
    <div class="card_self_wrapper">

        <?php
        $sql_show = "SELECT * FROM game WHERE Category LIKE '%action%'";
        $result = mysqli_query($conn, $sql_show);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['ID'];
                $name = $row['Name'];
                $price = $row['Price'];
                $cdesc = $row['Description'];
                $coverimage = $row['Cover_Image'];
                $discount = $row['Discount'];
                $discount_amount = ($price * $discount) / 100;
                $updated_price = $price - $discount_amount;

                echo '<a class="card_self" href="purchase-i.php?id=' . $id . '">';
                echo '<div class="img_div"><img src="image/' . $coverimage . '" alt=""></div>';
                echo '<div class="text">';
                echo '<p class="name_self">' . $name . '</p>';
                echo '<p class="price_self">';
                echo '<span>$' . $updated_price . '</span>'; // Price text
                if ($discount > 0) {
                    echo '<span class="badge bg-primary" style="background-color: #26BBFF">-' . $discount . '%</span>'; // Badge text
                }
                echo '</p>';
                echo '</div>';
                echo '</a>';
            }
        }
        ?>

    </div>
</div>
  
<h1 class="game_category_title">Horror Games</h1>

<div class="card_self_space_scroll">
    <div class="card_self_wrapper">
        <?php
        $sql_show = "SELECT * FROM game WHERE Category LIKE '%horror%'";
        $result = mysqli_query($conn, $sql_show);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['ID'];
                $name = $row['Name'];
                $price = $row['Price'];
                $cdesc = $row['Description'];
                $coveriamge = $row['Cover_Image'];
                $discount = $row['Discount'];
                $discount_amount = ($price * $discount) / 100;
                $updated_price = $price - $discount_amount;

                echo '<a class="card_self" href="purchase-i.php?id=' . $id . '">';
                echo '<div class="img_div"><img src="image/' . $coveriamge . '" alt=""></div>';
                echo '<div class="text">';
                echo '<p class="name_self">' . $name . '</p>';
                echo '<p class="price_self">';
                echo '<span>$' . $updated_price . '</span>';
                if ($discount > 0) {
                    echo '<span class="badge bg-primary" style="background-color: #26BBFF">-' . $discount . '%</span>';
                }
                echo '</p>';
                echo '</div>';
                echo '</a>';
            }
        }
        ?>
    </div>
</div>

<h1 class="game_category_title">Most Played Games</h1>

<div class="card_self_space_scroll">
    <div class="card_self_wrapper">
        <?php
        $sql_show = "SELECT * FROM game WHERE Users > 50000";
        $result = mysqli_query($conn, $sql_show);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['ID'];
                $name = $row['Name'];
                $price = $row['Price'];
                $cdesc = $row['Description'];
                $coveriamge = $row['Cover_Image'];
                $discount = $row['Discount'];
                $discount_amount = ($price * $discount) / 100;
                $updated_price = $price - $discount_amount;

                echo '<a class="card_self" href="purchase-i.php?id=' . $id . '">';
                echo '<div class="img_div"><img src="image/' . $coveriamge . '" alt=""></div>';
                echo '<div class="text">';
                echo '<p class="name_self">' . $name . '</p>';
                echo '<p class="price_self">';
                echo '<span>$' . $updated_price . '</span>';
                if ($discount > 0) {
                    echo '<span class="badge bg-primary" style="background-color: #26BBFF">-' . $discount . '%</span>';
                }
                echo '</p>';
                echo '</div>';
                echo '</a>';
            }
        }
        ?>
    </div>
</div>

<!-- card scroll ends -->

<!-- card starts -->

<h1 class="game_category_title">All Games</h1>

<div class="card_self_space">
    <div class="card_self_wrapper">
        <?php
        $sql_show = "SELECT * FROM game";
        $result = mysqli_query($conn, $sql_show);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['ID'];
                $name = $row['Name'];
                $price = $row['Price'];
                $cdesc = $row['Description'];
                $coveriamge = $row['Cover_Image'];
                $discount = $row['Discount'];
                $discount_amount = ($price * $discount) / 100;
                $updated_price = $price - $discount_amount;

                echo '<a class="card_self" href="purchase-i.php?id=' . $id . '">';
                echo '<div class="img_div"><img src="image/' . $coveriamge . '" alt=""></div>';
                echo '<div class="text">';
                echo '<p class="name_self">' . $name . '</p>';
                echo '<p class="price_self">';
                echo '<span>$' . $updated_price . '</span>';
                if ($discount > 0) {
                    echo '<span class="badge bg-primary" style="background-color: #26BBFF">-' . $discount . '%</span>';
                }
                echo '</p>';
                echo '</div>';
                echo '</a>';
            }
        }
        ?>
    </div>
</div>

    <!-- card end -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script>
    $('#carouselExampleSlidesOnly').carousel({
        interval: 2000 // Set interval to 2000 milliseconds (2 seconds)
    });
</script>

<br>
<br>
<footer class="bg-dark text-light py-4">
  <div class="container">
    <div class="row">
      <!-- Social Media Section -->
      <div class="col-md-3 col-sm-6 mb-3">
        <h5>Follow Us</h5>
        <ul class="list-unstyled">
          <li class="d-flex align-items-center mb-2">
            <img src="image/facebook.png" alt="Facebook Logo" class="me-2" style="width: 20px; height: 20px;">
            <a href="#" class="text-light text-decoration-none">Facebook</a>
          </li>
          <li class="d-flex align-items-center mb-2">
            <img src="image/instagram.png" alt="Instagram Logo" class="me-2" style="width: 20px; height: 20px;">
            <a href="#" class="text-light text-decoration-none">Instagram</a>
          </li>
          <li class="d-flex align-items-center">
            <img src="image/youtube.png" alt="YouTube Logo" class="me-2" style="width: 20px; height: 20px;">
            <a href="#" class="text-light text-decoration-none">YouTube</a>
          </li>
        </ul>
      </div>

      <!-- Resources Section -->
      <div class="col-md-3 col-sm-6 mb-3">
        <h5>For More Information</h5>
        <ul class="list-unstyled">
          <li class="mb-2">
            <a href="tel:021111111111" class="text-light text-decoration-none">(021)-111-111-111</a>
          </li>
          <li>
            <a href="home.php" class="text-light text-decoration-none">Home</a>
            <br>
            <a href="about.php" class="text-light text-decoration-none">About Us</a>
          </li>
        </ul>
      </div>

      <!-- Game Vault Section -->
      <div class="col-md-3 col-sm-6 mb-3">
        <h5>Game Vault</h5>
        <ul class="list-unstyled">
          <!-- Placeholder for additional links if needed -->
        </ul>
      </div>

      <!-- Company Logo -->
      <div class="col-md-3 col-sm-6 text-end">
        <img src="image/GV_logo-02.png" alt="Company Logo" class="img-fluid mb-2" style="max-width: 100px;">
        <p class="small mb-0">&copy; 2025 Game Vault. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
</body>
</html>