<?php
// Start the session at the very beginning of the script
session_start();

// Check if the user is already logged in, if so, redirect them to the homepage or dashboard
if (isset($_SESSION["login_status"]) && $_SESSION["login_status"] === TRUE) {
    header('Location: home.php');  // Redirect if logged in
    exit;
}

$host = 'localhost';
$dbname = 'gamevault';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
   
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $userID = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $age = $_POST['age'] ?? '';

    // Only proceed if both username and password are not empty
    
        try {
            $sql = $pdo->prepare("INSERT INTO `users`(`Name`, `UserID`, `Age`, `Password`) VALUES (:name,:email,:age,:password)");

            $sql->execute([
                ':name' => $username,
                ':email' => $userID,
                ':age' => $age,
                ':password' => $password
            ]);
            
            // Set session after successful registration
            $_SESSION["login_status"] = TRUE;
            $_SESSION["userID"] = $userID;  // Optionally store the user's email or ID

            // Redirect to the next page
            header('Location: home.php');
            exit;
        } catch (PDOException $e) {
            echo "<h2>Error: " . $e->getMessage() . "</h2>";
        }
     
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            body {
              background-color: #101014;
              color: #C6C6C6;
            }

            .form_wrapper_self {
              width: 100%;
              height: 100vh;
              display: flex;
              justify-content: center;
              align-items: center;
            }

            .form_wrapper_self form {
              width: 560px;
              background-color: #202024;
              padding: 50px;
              border-radius: 11px;
            }

            .form_wrapper_self form .btn {
              width: 100%;
              background-color: #353539;
              border: none;
              margin-top: 20px;
            }

            .form_wrapper_self form .btn:hover {
              background-color: #26BBFF;
              color: #101014;
            }
        </style>
</head>
<body>

<div class="form_wrapper_self">
  <form method="POST">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Name</label>
      <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Age</label>
      <input type="number" name="age" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    </div>

    <?php if ($error_message): ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $error_message; ?>
      </div>
    <?php endif; ?>

    <button type="submit" class="btn btn-primary">Sign In</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
