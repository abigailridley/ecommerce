
<?php
 include 'includes/footer.php';
include 'includes/nav.php';
?>

<div class="container mt-4">
<div class="d-flex flex-wrap justify-content-center">

<?php

//open db connection
	
 require ('includes/db_connect.php');
//retrieve items from 'products' db table

$q = "SELECT * FROM products";
$r = mysqli_query($link, $q);

if (mysqli_num_rows($r) > 0 ) {
    while ( $row = mysqli_fetch_array($r, MYSQLI_ASSOC ))
{
    echo '

<div class="m-2">
    <div class="card" style="width: 18rem;">
	 <img src='. $row['item_img'].' class="card-img-top" alt="T-Shirt">
	  <div class="card-body">
	   <h5 class="card-title text-center">' . $row['item_name'] .'</h5>
	   <p class="card-text">'. $row['item_desc'] . '</p>
     </div>
	  <ul class="list-group list-group-flush">
	   <li class="list-group-item"><p class="text-center">&pound' . $row['item_price'] . '</p></li>
	   <li class="list-group-item "><a class="btn btn-dark btn-lg btn-block" href="update.php?id='.$row['item_id'].'">
	   Update</a></li>
	   <li class="list-group-item"><a class="btn btn-dark btn-block" href="delete.php?item_id='.$row['item_id'].'">
	   Delete Item</a></li>
	  </ul>
	</div>
 
  </div>';
}
//close db connection

mysqli_close( $link) ; 
	}
else { echo '<p>There are currently no items in the table to display.</p>
	' ; }
	


?> 
</div>
</div>