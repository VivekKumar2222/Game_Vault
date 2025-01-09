<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About Us</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="about.css"> 
    </head>
<body>
    
    <?php
        include 'conn.php'; // Ensure the database connection is included.
        session_start();


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
                            <button id="side_bar_toggle" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                            Menu
                            </button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="active_link_nav" href="about.php">About</a>
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
                        <?php
                            if($_SESSION["login_status"] == TRUE)
                            {
                                echo '<a href="?log=true" id="login_nav" class="btn btn-outline-success" type="submit">LogOut</a>';
                                if(isset($_GET['log']))
                                {
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
                    <a class="nav-link text-white" href="#">Services</>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Contact</>
                </li>
            </ul>
        </div>
    </div>

     <!-- nav bar ends -->

    <div class="about-us-section">
        <h1 class="about-us-header">About Us</h1>

        <div class="about-us-content">
            <p>
            Welcome to Game Vault – Where Gamers Level Up! 🎮💥

            At Game Vault, we’re redefining what it means to be a gamer. This isn’t just a platform; it’s your one-stop haven for everything gaming. Whether you're on a quest for the latest blockbusters or hidden indie gems, we’ve got your back.

            Who We Are
            We’re gamers first, creators second. Born from a passion for gaming and a drive to connect with like-minded enthusiasts, Game Vault is built for the community, by the community. Think of us as your ultimate co-op partner, always bringing you the best in the gaming world!

            What Awaits You in the Vault?
            An Epic Game Library: Dive into a treasure trove of games spanning every genre imaginable. From adrenaline-pumping action to mind-bending strategy, it’s all here.
            Unbeatable Deals: Score jaw-dropping discounts and exclusive offers that make leveling up your collection easier than ever.
            A Thriving Gamer Community: Share your adventures, discover tips and tricks, and connect with a global network of gamers just like you.
            Our Vision
            Gaming isn’t just about winning—it’s about the journey, the challenges, and the connections we forge along the way. At Game Vault, we’re on a mission to unite gamers from every corner of the world and celebrate the passion that brings us together.

            Your next adventure begins here. 🎉 Gear up, dive in, and unlock endless possibilities with Game Vault. Together, let’s make gaming legendary!  

            </p>
        </div>

        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.0190974999527!2d-122.4194151846819!3d37.77492977975932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858064c2d3d4a3%3A0x6477ec17a8bf4fcb!2sSan%20Francisco%2C%20CA%2C%20USA!5e0!3m2!1sen!2s!4v1605034325438!5m2!1sen!2s"
                allowfullscreen=""
                aria-hidden="false"
                tabindex="0">
            </iframe>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

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