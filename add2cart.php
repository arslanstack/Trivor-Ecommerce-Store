<?php
error_reporting(0);
session_start();
// session_destroy();


if (!$_SESSION['sessionuser']) {
    if (!$_SESSION['cart']) {
        $_SESSION['cart'] = array();
    }

    $_SESSION['cart'][$_SESSION['product']] = $_SESSION['quantity'];
    var_dump($_SESSION['cart']);
    header("Location: shop.php");
} else {
    $quantity = $_SESSION['quantity'];
    require_once "config.php";

    $sql = "SELECT * FROM product WHERE prodid = '{$_SESSION['product']}'";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $prodid = $row['prodid'];
            $img = $row['img'];
            $category = $row['category'];
            $name = $row['name'];
            $price = $row['price'];
            $info = $row['info'];
            $status = $row['status'];
            $username =  $_SESSION['userid'];
            $sql = "SELECT * FROM cartproduct WHERE prodid = '{$prodid}' AND username = '{$username}'";
            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    header("Location: shop.php");
                } else {
                    $sql = "INSERT INTO cartproduct (username, prodid, img, category, name, price, info, status, quantity)
                            VALUES ('{$username}','{$prodid}', '{$img}', '{$category}', '{$name}', '{$price}', '{$info}', '{$status}', '{$quantity}')";
                    if (mysqli_query($conn, $sql)) {
                        echo "Record Inserted";
                        header("Location: shop.php");
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            }
        }
    }
}
