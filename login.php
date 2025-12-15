<?php
include ('includes/nav.php');
include ('includes/footer.php');



if (isset($errors) && !empty($errors)) {
    echo '<div class="alert alert-danger" id="err_msg">';
    echo '<strong>Errors:</strong><br>';
    foreach ($errors as $msg) {
        echo "- $msg<br>";
    }
    echo '</div>';
}
?>

<div class="container">
	<h1>Login</h1>
<form action="login_action.php" method="post">
  <label for="inputemail">Email</label>
  <input type="text" 
		 name="email" 
		 class="form-control" 
		 required 
		 placeholder="example@email.com"> 
		<label for="inputpassword">Password</label>
  <input type="password" 
		 name="pass"  
	     class="form-control" 
		 required 
	     placeholder="password123">

  <input type="submit" value="Login">
  

</form>
<button ><a href="register.php">Register</a></button>
</div>