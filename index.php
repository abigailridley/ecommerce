<?php 
include 'includes/nav.php';
include 'includes/footer.php';

session_start();

//check if user is logged in and display welcome message
if (isset($_SESSION['first_name'])) {
     $name = ucfirst(strtolower($_SESSION['first_name']));
 } else {
     $name = null;
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class='container'><h1 class="text-center">
yoga studio</h1></div>
</body>
</html>