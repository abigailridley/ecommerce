<?php

include 'includes/session-cart.php';


//check for order conditions
if (isset($_GET['total']) && isset($_GET['total'] > 0) && (!empty($_SESSION['cart']))
) {
    //connect to database
    require 'includes/db_connect.php';
    //store data in database
    $q = "INSERT INTO orders (user_id, total, order_date) VALUES (
    {$_SESSION['user_id']}, {$_GET['total']}, NOW() )";
    $r = mysqli_query($link, $q);
    //get the order id
    $order_id = mysqli_insert_id($link);
    //retrieve cart items
    $q = "SELECT * FROM products WHERE item_id IN (";
    foreach ($_SESSION['cart'] as $id => $value) {
        $q .= $id . ',';
    }
    $q = substr($q, 0, -1) . ') ORDER BY item_id ASC';      
    $r = mysqli_query($link, $q);
    //store order items in db
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) 
        {
  $query = "INSERT INTO order_contents ( order_id, item_id, quantity, price )
  VALUES ( $order_id, 
         ".$row['item_id'].",
         ".$_SESSION['cart'][$row['item_id']]['quantity'].",
         ".$_SESSION['cart'][$row['item_id']]['price'].")" ;
  $result = mysqli_query($link,$query);
}
    //close db connection
    mysqli_close($link);
   
    //display thank you message
    echo "<p>Thank you for your order. Your order number is #" . $order_id . ".</p>";
     //clear the cart
    unset($_SESSION['cart']);
    else {
        echo "<p>Your cart is empty or an error occurred. Please try again.</p>";
    }
}