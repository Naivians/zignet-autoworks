<?php
define('MB', 1048576);
if (isset($_POST['submit'])) {
    $img_size = $_FILES['img']['size'];
    $img_error = $_FILES['img']['error'];

    /**
        File errors
        Value: 4; No file was uploaded. 
        Value: 0; There is no error, the file uploaded with success.
        Value: 6; Missing a temporary folder.
        Value: 7; Failed to write file to disk.
    */
    
    $fileErrors = array(
        0 => $img_error,
        4 => "No file was uploaded",
        6 => "Missing a temporary folder",
        7 => "Failed to write file to disk."
    );

    

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="img.php" method="post" enctype="multipart/form-data">

        <input type="file" name="img" id=""> <br>
        <input type="submit" value="Upload" name="submit">

    </form>

</body>

</html>