<?php
include 'includes/nav.php';
include 'includes/footer.php';

//update function from read.php
$id = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //connect to DB
    require ('includes/db_connect.php');

    //empty error array
    $errors = array();
    
    // If the form POSTed an id, prefer that (keeps the id when the form submits without query string)
    if (isset($_POST['id'])) {
        $id = (int) $_POST['id'];
    }

    //check for item name
    if (empty($_POST['item_name']))
    { $errors[] = 'Update item name'; }
    else
    { $n = mysqli_real_escape_string($link, trim($_POST['item_name'])); }

    //check for item desc
    if (empty($_POST['item_desc']))
    { $errors[] = 'Update item description';}
    else 
    { $d = mysqli_real_escape_string($link, trim ($_POST['item_desc']));}

    //check for item img
    if (empty($_POST['item_img']))
    { $errors[] = 'Update image address';}
    else
    { $img = mysqli_real_escape_string($link, trim ($_POST['item_img']));}

    //check for item price
    if (empty($_POST['item_price']))
    { $errors[] = 'Update item price';}
    else
    { $p = mysqli_real_escape_string($link, trim ($_POST['item_price']));}

// check for errors and update item
if (empty($errors))
{
    // Update the record (don't change item_id, otherwise primary key could get changed)
    $q= "UPDATE products SET item_name='$n', item_desc='$d', item_img='$img', item_price='$p' WHERE item_id='$id'";
    $r = @mysqli_query ($link, $q);
    if ($r)
    {
        // Redirect back to admin read page so the updated record is visible
        header ("Location: read.php");
    } else {
        echo "Error updating record " . $link->error;
    }
    //close db connection
    mysqli_close($link);
}

}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] =='GET' && isset($id)) {
    require ('includes/db_connect.php');

    $q = "SELECT * FROM products WHERE item_id='$id' LIMIT 1";
    $r = mysqli_query($link, $q);

    if ($r && mysqli_num_rows($r) == 1) {
        $row = mysqli_fetch_assoc($r);

        //pre fill variables for the update form
        $item_name = $row['item_name'];
        $item_desc = $row['item_desc'];
        $item_img = $row['item_img'];
        $item_price = $row['item_price'];
    }
    mysqli_close($link);

}
?>

<div class="container">
    <h1>Update class: <?php echo $item_name ?? ''; ?></h1>
<form action="update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
   <label for="item_name">Class name: </label>
<input type="text" name="item_name" class="form-control" value="<?php echo $_POST['item_name'] ?? $item_name ?? ''; ?>">
  <label for="item_desc">Description: </label>
<input type="text" name="item_desc" class="form-control" value="<?php echo $_POST['item_desc'] ?? $item_desc ?? ''; ?>">
  <label for="item_desc">Image: </label>
<input type="text" name="item_img" class="form-control" value="<?php echo $_POST['item_img'] ?? $item_img ?? ''; ?>">
  <label for="item_desc">Price: </label>
<input type="number"
id="item_price"
class="form-control"
name="item_price"
min="0" step="0.01" 
value="<?php echo $_POST['item_price'] ?? $item_price ?? ''; ?>">

 <input type="submit" class="btn btn-dark" value="Submit">
</form>
</div>

