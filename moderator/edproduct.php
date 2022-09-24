<?php
session_start();
// echo $_SESSION['editee'];
require './../config.php';

$sql = "SELECT * FROM product WHERE prodid = '{$_SESSION['editee']}'";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $idr = $row['prodid'];
            $namer = $row['name'];
            $categoryr = $row['category'];
            $pricer = $row['price'];
            $statusr = $row['status'];
            $infor = $row['info'];
        }
        // Free result set
        mysqli_free_result($result);
    } else {
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
    }
} else {
    echo "Oops! Something went wrong. Please try again later.";
}

if (isset($_POST['id'])) {
    require './../config.php';

    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $price = $_POST['price'];
    $info = $_POST['info'];

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'webp');

    if ($fileSize < 1) {
        $sql = "UPDATE product SET prodid = '{$id}', name = '{$name}', status = '{$status}', info = '{$info}', price = '{$price}', category = '{$category}' WHERE prodid = '{$id}'";
        if (mysqli_query($conn, $sql)) {
            echo "Record Updated";
            header("Location: productview.php");
        } else {
            echo "Record not inserted";
        }
    } else {
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = './../uploads/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $sql = "UPDATE product SET prodid = '{$id}', name = '{$name}', status = '{$status}', info = '{$info}', price = '{$price}', category = '{$category}', img = '{$fileDestination}' WHERE prodid = '{$id}'";
                    if (mysqli_query($conn, $sql)) {
                        echo "Record Updated";
                        header("Location: productview.php");
                    } else {
                        echo "Record not inserted";
                    }
                } else {
                    echo "File Size too big";
                }
            } else {
                echo "File Error Occured";
            }
        } else {
            echo "Invalid Filetype";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="style1.css" rel="stylesheet">
    <title>Edit Details</title>
</head>

<body>
    <br><br><br>
    <section class="container mx-auto">

        <div class="row">
            <div class="col-2"></div>
            <form class="col-8 border py-4" action="" method="post" enctype="multipart/form-data">
                <h1 class="display-4 text-center">Add Product</h1>
                <br><br>
                <div class="form-row">
                    <div class="col-6">
                        <input type="text" required class="form-control" placeholder="ID" value="<?php echo $idr ?>" name="id" readonly>
                    </div>
                    <div class="col">
                        <input type="text" required class="form-control" placeholder="Name" value="<?php echo $namer ?>" name="name">
                    </div>

                </div>
                <br>
                <div class="form-row">
                    <div class="col">
                        <input type="text" name="price" required class="form-control" value="<?php echo $pricer ?>" placeholder="Price ($)">
                    </div>

                    <div class="col">
                        <select class="form-control" required name="category">
                            <option selected><?php echo $categoryr ?></option>
                            <option>Category</option>
                            <option>Shirts</option>
                            <option>Glasses</option>
                            <option>Shoes</option>
                            <option>Watches</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col">
                        <select class="form-control" required name="status">
                            <option selected><?php echo $statusr ?></option>
                            <option>Status</option>
                            <option>Available</option>
                            <option>Unavailable</option>
                        </select>
                    </div>

                </div>
                <br>

                <div class="form-row">

                    <div class="col-6">
                        <label for="exampleFormControlTextarea1">Product Information</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" required name="info" rows="3"><?php echo $infor ?></textarea>
                    </div>
                    <div class="form-group col-6">
                        <label for="exampleFormControlFile1">Product Image</label>
                        <input type="file" class="form-control-file" name="file">
                    </div>
                </div>
                <br>
                <input type="submit" value="Update Product" class="btn btn-primary">
                <a href="javascript:history.back()" class="btn btn-dark">Cancel</a>
            </form>
            <div class="col-2"></div>

        </div>
    </section>

    <!-- JS Popper Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>'