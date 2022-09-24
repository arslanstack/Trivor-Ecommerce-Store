<?php
session_start();
$totalamount = 0;
$count = 0;
require_once "config.php";
$sql = "INSERT INTO sales (username, status) VALUES ('{$_SESSION['userid']}','processing')";
if (mysqli_query($conn, $sql)) {
    $sql = "SELECT * FROM sales  WHERE username = '{$_SESSION['userid']}' AND status = 'processing' ORDER BY orderno DESC LIMIT 1";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $orderno = $row['orderno'];
        } else {
            echo "Error 3: ";
        }
    } else {
        echo "Error 2: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Error 1: " . $sql . "<br>" . mysqli_error($conn);
}


$sql = "SELECT * FROM cartproduct WHERE username = '{$_SESSION['userid']}'";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $prodid = $row['prodid'];
            $quantity = $row['quantity'];
            $_SESSION['payquantity'] = $quantity;
            $price = $row['price'];
            $name = $row['name'];
            $thingamount = ($price * $quantity);
            // INSERT INTO `order` (`username`, `orderid`, `prodid`, `quantity`, `amount`) VALUES ('beingarslan', '7', '3', '2', '19.98');
            $sql = "INSERT INTO orders (username, orderid, prodid, name, price, quantity, amount) VALUES ('{$_SESSION['userid']}', '{$orderno}' , '{$prodid}', '{$name}', '{$price}', '{$quantity}', '{$thingamount}')";
            if (mysqli_query($conn, $sql)) {
                $totalamount += $thingamount;
            } else {
                echo "Error 5: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
} else {
    echo "Error 4: " . $sql . "<br>" . mysqli_error($conn);
}
$sql = "UPDATE sales SET amount = '{$totalamount}' WHERE username = '{$_SESSION['userid']}' AND status = 'processing' ORDER BY orderno DESC LIMIT 1";
if (mysqli_query($conn, $sql)) {

    require 'ordermail.php';
        mailed($_SESSION['usermail'], $_SESSION['userid'], $_SESSION['username'], $orderno, $totalamount);
        $_SESSION['orderno'] = $orderno;
        $_SESSION['totalamount'] = $totalamount;
        header("Location: orderstagefour.php");
    
} else {
    echo "Error 6: " . $sql . "<br>" . mysqli_error($conn);
}
