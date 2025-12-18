<?php
include ('includes/nav.php');
include ('includes/footer.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //connect to db
    require ('includes/db_connect.php');



    //initialise errors array
    $errors = array();

    //check for first name
if ( empty($_POST['first_name']))
{ $errors[] = 'Enter your first name';}
else
{ $fn = mysqli_real_escape_string( $link, trim( $_POST['first_name']));
$ln = mysqli_real_escape_string($link, trim($_POST['last_name']));}

//check for existing passwords and matching inputs
if( !empty($_POST['pass1']))
{
    if ( $_POST['pass1'] != $_POST['pass2'])
    { $errors[] = "Passwords do not match";}
    else
    { $p = mysqli_real_escape_string( $link, trim($_POST['pass1']));
    //hash password
    $hashed_pass = password_hash($p, PASSWORD_DEFAULT);
    }
}
else { $errors[] = 'Enter your password';}

if (empty($errors))
{
    $e  = mysqli_real_escape_string($link, trim($_POST['email']));
    $q = "SELECT user_id FROM users WHERE email='$e'";
    $r = @mysqli_query ($link, $q);
    if ( mysqli_num_rows($r) != 0)
        $errors[]= 'Email address already registered. 
<a class="alert-link" href="login.php">Sign In Now</a>' ;
}
if (empty($errors))
{
    $q = "INSERT INTO users (first_name, last_name, email, pass, reg_date) VALUES ('$fn','$ln','$e','$hashed_pass', NOW() )";
    $r = @mysqli_query ($link, $q);
    if ($r)
    {
        echo '<p>You are now registered</p>
	  <a class="alert-link" href="login.php">Login</a>';
    }
    //close db connection
    mysqli_close($link);
    exit();
}
    // or report errors
    else 
    {
           echo '<h4 class="alert-heading" id="err_msg">The following error(s) occurred:</h4>' ;
           foreach ($errors as $msg)
            {echo " - $msg<br>";}
           echo  '<p>or please try again.</p></div>';
           //close db connection
           mysqli_close($link);
    }
}


?>
<div class="container">
<form action="register.php" method="post">
<label for="inputfirst_name">First Name</label>
   <input type="text" 
          name="first_name" 
          required 
          placeholder="First Name " 
          value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>"> 
				
  <label for="inputlast_name">Last Name</label>
	<input type="text" 
	       name="last_name" 
	       class="form-control" 
	       required 
	       placeholder="Last Name" 
	       value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
			
	<label for="inputemail">Email</label>
	  <input type="email" 
	         name="email" 
	         class="form-control" 
	         required 
	         placeholder="email@example.com" 
	         value="<?php if (isset($_POST['email'])) 
	           echo $_POST['email']; ?>">
					
			
	<label for="inputpass1">Create new password</label>
		<input type="password"
		       name="pass1" 
		       class="form-control" 
		       required 
		       placeholder="Password" 
		       value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>">
					 
					 
	<label for="inputpass2">Confirm Password</label>
		<input type="password" 
		       name="pass2" 
		       class="form-control" 
		       required 
		       placeholder="Confirm password" 
		       value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>">
					
				
		<input type="submit" 
		       value="Create Account">



</form></div>