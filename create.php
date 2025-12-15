<?php
 include 'includes/footer.php';
  include 'includes/nav.php';

  //connect to db
  require('includes/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //initialise error array
    $errors=array();

//check for item name
   if (empty($_POST['item_name']))
    {
        $errors[] = 'Enter the item name.'; 
    } else {
        $n = mysqli_real_escape_string($link, trim($_POST['item_name']));
    }
    //check for item desc
    if (empty($_POST['item_desc']))
    {$errors[] = 'Enter item description';}
    else
    {$d = mysqli_real_escape_string($link, trim($_POST['item_desc']));}

    //item img
    if (empty($_POST['item_img']))
    {$errors[] = 'Enter the item image.';}
    else 
    {$img = mysqli_real_escape_string($link, trim($_POST['item_img']));}

    //item price
    if (empty($_POST['item_price']))
    {$errors[]='Enter the item price';}
    else{$p = mysqli_real_escape_string($link, trim($_POST['item_price']));}

    //enter data into table on success
    if (empty($errors))
    {
        $q = "INSERT INTO products(item_name, item_desc, item_img, item_price)
        VALUES ('$n', '$d', '$img','$p')";
        $r = mysqli_query($link, $q);
        if ($r) 
           {
        // Redirect back to admin read page
        header ("Location: read.php");
    } else {
        echo "Error updating record " . $link->error;
    }
   # Close database connection.
    mysqli_close($link); 
    exit();
}

}


?>

    <div class="container mt-5">
        <div class="card p-5">
   <h1>Add class</h1>
   
    <form action="create.php" method="post">
<!-- input box for item name -->
 <label for="name">Class name:</label>
<input type="text"
id="item_name"
class="form-control"
name="item_name"
required
value="<?php if (isset($_POST['item_name'])) echo $_POST['item_name'];?>">

<!-- input for item desc -->
 <label for="description">Description:</label>
 <textarea 
 id="item_desc"
 class="form-control"
 name="item_desc"
 required><?php if (isset($_POST['item_desc'])) echo $_POST ['item_desc']; ?> </textarea>

<!-- input for image path -->
 <label for="image">Image:</label>
<input type="text"
id="item_img"
class="form-control"
name="item_img"
required
value="<?php if (isset($_POST['item_img'])) echo $_POST['item_img']; ?>">

<!-- input for item price -->
<label for="price">Price</label>
<input type="number"
id="item_price"
class="form-control"
name="item_price"
min="0" step="0.01"
required
value="<?php if (isset($_POST['item_price'])) echo $_POST['item_price'] ?>">

<!-- submit button -->

<div class=" d-flex justify-content-end">
 <input type="submit" class="btn btn-dark mt-2 " value="Submit"> </div>
    </form>
</div>
   </div>
