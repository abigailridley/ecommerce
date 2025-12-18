<?php

include 'includes/nav.php';

include 'includes/session-cart.php';

//view shopping cart

//check if form has been submitted to update cart quantities
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //loop through each item and update quantity
    foreach ($_POST['qty'] as $item_id => $itm_qty) 
        {
        //ensure quantity is a positive integer
        $id = (int)$item_id;
        $qty = (int)$itm_qty;

        //change qty or delete if zero
      if ($qty == 0) {
          unset($_SESSION['cart'][$id]);
      } elseif ($qty > 0) {
          $_SESSION['cart'][$id]['quantity'] = $qty;
        }
    }

}
  
//initialise total cost variable
$total = 0;
//check if cart is not empty
if (!empty($_SESSION['cart'])) {
    //connect to database
    require 'includes/db_connect.php';
    //build sql query
    $q = "SELECT * FROM products WHERE item_id IN (";
    foreach ($_SESSION['cart'] as $id => $value) {
        $q .= $id . ',';
    }
    $q = substr($q, 0, -1) . ') ORDER BY item_id ASC';
    $r = mysqli_query($link, $q);
    //display cart items in a form
    echo '<form action="cart.php" method="post">';
  while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
  {
    // calculate subtotals and grand total
    $subtotal = $_SESSION['cart'][$row['item_id']]['quantity'] * $_SESSION['cart'][$row['item_id']]['price'];
    $total += $subtotal;
    //display each item

    echo "{$row['item_name']} 
    <input type=\"text\" 
           size=\"3\" 
           name=\"qty[{$row['item_id']}]\" 
           value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\">
    <br>@ {$row['item_price']} = 
	
	<br> &pound ".number_format ($subtotal, 2)." ";

  }
  # Display the total.
  echo ' <p>Total = &pound '.number_format($total,2).'</p>
         <p><input type="submit" name="submit" class="btn btn-light btn-block" value="Update My Cart"></p>
	<br>
        <a href="checkout.php?total='.$total.'" class="btn btn-light btn-block">Checkout Now</a><br>
  </form>';
} else {
    echo '<p>Your cart is currently empty.</p>';    

  }
//close db connection
mysqli_close($link);

include 'includes/footer.php';
?>