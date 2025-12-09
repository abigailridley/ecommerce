<?php
include ('includes/nav.php');
include ('includes/footer.php');


?>

<div>
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