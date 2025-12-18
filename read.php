
<?php
 include 'includes/footer.php';
include 'includes/nav.php';
?>

<div class="container mt-4">
	<div class="text-center">
	<h1>Admin Dashboard</h1>
	<a href="create.php">Create new class</a></div>
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
	   <li class="list-group-item"><button 
    class="btn btn-dark d-block w-100" 
    data-bs-toggle="modal" 
    data-bs-target="#deleteModal"
    data-id="'.$row['item_id'].'">
    Delete
</button></li>
	  </ul>
	</div>
 
  </div>';
}
//close db connection

mysqli_close( $link) ; 
	}
else { echo '<p>There are currently no classes available.</p>
	' ; }
	


?> 
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Are you sure?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        This action cannot be undone.
      </div>

      <div class="modal-footer">
        <a id="confirmDelete" class="btn btn-danger">Delete</a>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var deleteModal = document.getElementById('deleteModal');

  deleteModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var itemId = button.getAttribute('data-id');
    var confirmDelete = document.getElementById('confirmDelete');
    confirmDelete.setAttribute('href', 'delete.php?item_id=' + itemId);
  });
});
</script>