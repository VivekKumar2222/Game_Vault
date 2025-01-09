<?php
  session_start();
  include 'conn.php';
  
  $id = $_GET['id'];

  $sql_show = "SELECT * FROM game WHERE ID = $id";

    $result = mysqli_query($conn, $sql_show);
  if($result){

    $row = mysqli_fetch_assoc($result);

    $db_id = $row['ID'];
        $name = $row['Name'];
        $price = $row['Price'];
        $cdesc = $row['Description'];
        $logo = $row['Logo'];
        $keyart = $row['Key_Art'];
        $discount = $row['Discount'];
        $category = $row['Category'];
        $discount_amount = ($price * $discount) / 100;
        $updated_price = $price - $discount_amount;
  }

  if (isset($_POST['add_to_cart'])) {
    if ($_SESSION['login_status']) {

      if (isset($_SESSION["userID"])) {
        $userID = $_SESSION["userID"];
    }
    else{
      echo "login Failed";
    }

      
      
      $checking_sql = "SELECT * FROM carts where ItemName = '$name' And UserID = '$userID'";
      $check_result = mysqli_query($conn, $checking_sql);

      // $row_check = mysqli_fetch_assoc($check_result);

      if(mysqli_num_rows($check_result) > 0){
        echo '<script>alert("Already in Cart");</script>';
      }
      else{
        

        $sql_insert = "INSERT INTO `carts` (`ItemName`, `ItemID`, `ItemDescription`, `ItemPrice`, `ItemCategory`, `UserID`) 
                       VALUES ('$name', '$id', '$cdesc', '$updated_price', '$category', '$userID')";
        $result_in = mysqli_query($conn, $sql_insert);
        if ($result_in) {
          echo "<script>alert('Item added to cart');</script>";
          header("Location: purchase-i.php?id=$id");  // Redirect to avoid re-submission
          exit();
      } else {
          echo "<script>alert('Error adding item to cart');</script>";
      }

      }
      
        
    } else {
        echo "<script>alert('Login First!');</script>";
    }
}
  

  
  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Purchase</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="purchase_index.css">
</head>
  <body>

  <!-- nav bar starts -->

 
    
<div class="nav-wrapper-self">
    <div class="logo_img">
        <img src="image/GV_logo-02.png" alt="">
    </div>
    <nav class="navbar navbar-expand">
        <div class="container-fluid">
          <!-- <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-0">
            
    <!-- <a class="navbar-brand" href="#">
      <img src="image/fortnite-logo-white-png-900x257.png" alt="Bootstrap" width="65" height="auto">
    </a> -->
              <li class="nav-item">
              <button id="side_bar_toggle" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
              Menu
              </button>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="active_link_nav" aria-current="page" href="home.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Collection
                </a>
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
              <!-- <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
              </li> -->
              <li class="nav-item" >
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
            <div class="d-flex" >
              <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
               <?php
               if($_SESSION["login_status"] == TRUE){
                echo '<a href="?log=true" id="login_nav" class="btn btn-outline-success" type="submit">LogOut</a>';
                if(isset($_GET['log'])){
                  session_destroy();
                }
                
               }
               else{

              
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
     <!-- nav bar ends -->



    <div class="container_self_wrapper">
   <div class="container_self">
<div class="left_side">
    <div class="game_img_detail">
        <img src="image/<?php
        echo $keyart;
        ?>" alt="">
        <div class="game_detail">
            <!-- <div class="game_name">Halo 4</div>
            <div class="game_detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut </div> -->
        </div>

    </div>
    <div class="description_game"><?php
    echo $cdesc;
    ?></div>
</div>




<div class="right_side">
    <img src="image/<?php
    echo $logo;
    ?>" alt="">
    <button type="button" class="btn btn-secondary">Base Game</button>
    
    <div class="price_detail">
      <?php
      
      if($discount > 0){
    echo '<span class="badge bg-primary" style="background-color: #26BBFF">'. '-' . $discount . '%' .'</span>';
    echo '<span class="price" >'. $updated_price .'</span>';
  }
  else{
    echo '<span class="price" style="margin-left: 0px;">' . '$' . $updated_price . '</span>';

  }
    ?>
    
</div>
                
<div class="action_button">
  <?php

  

  if($_SESSION["login_status"] == TRUE){

    $userID = $_SESSION["userID"];
  $cart_check = "SELECT * FROM carts WHERE UserID = '$userID'";
  $cart_check_result = mysqli_query($conn, $cart_check);

  $cart_count = mysqli_num_rows($cart_check_result);
  
  if($cart_count == 0){
    echo '<a href="cart.php" class="view_cart">View Cart
    <span class="badge text-bg-secondary ms-2"></span>
    </a>';
  } 

  elseif($cart_count > 0){
    echo '<a href="cart.php" class="view_cart">View Cart
    <span class="badge text-bg-secondary ms-2">'. $cart_count .'</span>
    </a>';
  }
  }
  else{
    echo '<a href="cart.php" class="view_cart">View Cart</a>';
  }
    ?>
    <form method="POST" action="">
            <button type="submit" name="add_to_cart" class="add_to_cart">Add to Cart</button>
        </form>
    
</div>

<div class="purchase_note">
    
    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et 
</div>
</div>


   </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    
  </script>
  </body>
</html>