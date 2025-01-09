<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
    <form action="connection2.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="name"> <br>
        <input type="number" step="any" name="price" placeholder="price"> <br>
        <input type="text" name="desc" placeholder="desc"> <br>
        <input type="text" name="category" placeholder="category"> <br>
        <input type="number" name="users" placeholder="users"> <br>
        <input type="number" name="discount" placeholder="discount"> <br>
        <input type="file" name="coverimage" placeholder="cover art"> <br>
        <input type="file" name="logo" placeholder="logo"> <br>
        <input type="file" name="keyart" placeholder="key art"> <br>
        <button type="submit" name="submit">Submit</button><br>
    </form>
</body>
</html>
