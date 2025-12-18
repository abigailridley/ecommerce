<?php

include 'includes/nav.php';
include 'includes/footer.php';


include 'includes/session-cart.php';



//get item id from url
if (isset($_GET['id']))   {

$id = $_GET['id'];
require 'includes/db_connect.php';

//query product details from database
$q = "SELECT * FROM products WHERE item_id = $id";
$r = mysqli_query($link, $q);

// handle query result
if (mysqli_num_rows($r) == 1) {
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    $item_name = $row['item_name'];
    $item_price = $row['item_price'];
}
//manage cart check if item already in cart
if (isset($_SESSION['cart'][$id])) {
    //item already in cart, increase quantity
    $_SESSION['cart'][$id]['quantity']++;
    echo '
    <div class="container">
			<div class="alert alert-secondary" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<p>Another '.$row["item_name"].' has been added to your cart</p>
				<a href="classes.php">Book another class</a> | <a href="cart.php">View Your Cart</a>
			</div>
		</div>';
} else {
//or add new item to cart
   
   $_SESSION['cart'][$id]= array ( 'quantity' => 1, 'price' => $row['item_price'] ) ;
    echo '<div class="container">
			<div class="alert alert-secondary" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<p>A '.$row["item_name"].' has been added to your cart</p>
			<a href="classes.php">Continue Shopping</a> | <a href="cart.php">View Your Cart</a>
			</div>
		</div>' ;
  
}
//close db connection
mysqli_close($link);
}

?>