<?php

session_start();

//check if user is logged in and save name as capitalised variable
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
    <title>e-commerce platform</title>
     <link rel="stylesheet" 
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
crossorigin="anonymous">
</head>
<body>
    <nav class="navbar bg-dark navbar-dark ">
    <ul class="navbar-nav flex-row justify-content-center w-100">
  <li class="nav-item mx-3">
     <a class="navbar-brand" href="index.php">
    🌅
    </a>
  </li>
  <li class="nav-item mx-3">
    <a class="nav-link" href="index.php">Home</a>
  </li>
  <li class="nav-item mx-3">
    <a class="nav-link" href="#">Classes</a>
  </li>
  <li class="nav-item mx-3">
    <a class="nav-link" href="#" >About</a>
  </li>
   <li class="nav-item mx-3">
    <a class="nav-link" href="read.php" >Admin</a>
  </li>
   <?php if (isset($_SESSION['user_id'])) : ?>
    <li class="nav-item mx-3 font-italic text-light"> Welcome, <?php echo htmlspecialchars($name); ?> </li>
  <?php endif; ?>
  <?php if (isset($_SESSION['user_id'])) : ?>
    <li class="nav-item mx-3">
    <a class="nav-link" href="logout.php" >Logout</a> </li>
  <?php else : ?>
    <li class="nav-item mx-3">
    <a class="nav-link" href="login.php" >Login</a> </li>
  <?php endif; ?>
 
</ul>
</nav>
</body>
</html>