

<?php

include 'includes/nav.php';
include 'includes/footer.php';

require 'includes/db_connect.php';
session_start();



//check if user is logged in and display availabl classes from database
if (isset($_SESSION['first_name'])) {
     $name = ucfirst(strtolower($_SESSION['first_name']));
     echo "<h2>Available Classes for " . htmlspecialchars($name) . ":</h2>";
     echo '<div class="row">';
     //fetch items from database
     $q = "SELECT * FROM products";
     $r = mysqli_query($link, $q);
     if (mysqli_num_rows($r) > 0) {
         while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
             echo '
             <div class="col-md-3 d-flex justify-content-center mb-4">
                 <div class="card" style="width: 18rem;">
                     <img src="' . $row['item_img'] . '" class="card-img-top" alt="' . $row ['item_name'] . '">
                     <div class="card-body text-center">
                        <h5 class="card-title">' . $row['item_name'] . '</h5>
                        <p class="card-text">' . $row['item_desc'] . '</p>
                        </div>
                        <div class="card-footer bg-transparent border-dark text-center">
                        <p class="card-text">&pound;' . $row['item_price'] . '</p>
                        </div>
                        <div class="card-footer text-muted text-center">
                        <a href="added.php?id=' . $row['item_id'] . '" class="btn btn-dark">Book Now</a>
                        </div>
                        </div>
             </div>
             ';
             //close db connection
             mysqli_close($link);
         }
 } else {
     $name = null;
     echo "<p>Please <a href='login.php'>log in</a> to see available classes.</p>";
    }
}

?>
