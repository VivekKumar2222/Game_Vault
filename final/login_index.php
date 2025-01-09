<?php
session_start();
$error_message = '';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = $pdo->prepare("SELECT * FROM `users` WHERE UserID = :email");
    $sql->execute([':email' => $email]);

    if ($sql->rowCount() > 0) {
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        $stored_password = $user['Password'];
        $_SESSION["userID"] = $user['UserID'];

        if ($stored_password === $password) {
            $_SESSION["login_status"] = true;
            header('Location: home.php');
            exit;
        } else {
            $error_message = 'Invalid email or password.';
        }
    } else {
        $error_message = 'No account found with the provided email.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
        </div>
        <?php if ($error_message): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Log In</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
