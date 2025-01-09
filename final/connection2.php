<?php
// Establish PDO connection
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

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['desc']; // Fixed missing semicolon
    $category = $_POST['category'];
    $users = $_POST['users'];
    $discount = $_POST['discount'];
    $file_name_1 = $_FILES['coverart']['name'];
    $tempname_1 = $_FILES['coverimage']['tmp_name'];
    $file_name_2 = $_FILES['logo']['name'];
    $tempname_2 = $_FILES['logo']['tmp_name'];
    $file_name_3 = $_FILES['keyart']['name'];
    $tempname_3 = $_FILES['keyart']['tmp_name'];
    $folder1 = 'image/' . $file_name_1;
    $folder2 = 'image/' . $file_name_2;
    $folder3 = 'image/' . $file_name_3;

    try {
        // Prepare the SQL query using placeholders
        // $query = $pdo->prepare("INSERT INTO `image_table_2`(`Name`, `Price`, `Description`, `Image`) 
        //                         VALUES (:name, :price, :desc, :file_name)");
        $query = $pdo->prepare("INSERT INTO `game`(`Name`, `Price`, `Description`, `Category`, `Users`, `Cover_Image`, `Logo`, `Key_Art`, `Discount`) 
                                       VALUES (:name, :price, :desc, :category, :users, :file_name1, :file_name2, :file_name3, :discount)");

        // Execute the query with the data
        $query->execute([
            ':name' => $name,
            ':price' => $price,
            ':desc' => $desc,
            ':category' => $category,
            ':users' => $users,
            ':file_name1' => $file_name_1,
            ':file_name2' => $file_name_2,
            ':file_name3' => $file_name_3,
            ':discount' => $discount
        ]);

        // Move the uploaded file to the desired folder
        if (move_uploaded_file($tempname_1, $folder1) && move_uploaded_file($tempname_2, $folder2) && move_uploaded_file($tempname_3, $folder3)) {
            echo "<h2>File uploaded successfully</h2>";
        } else {
            echo "<h2>File not uploaded successfully</h2>";
        }
    } catch (PDOException $e) {
        echo "<h2>Error: " . $e->getMessage() . "</h2>";
    }
}
?>
