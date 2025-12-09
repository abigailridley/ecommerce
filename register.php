<?php
include ('includes/nav.php');
include ('includes/footer.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //connect to db
    require ('db_connect.php');

    //initialise errors array
    $errors = array();

    //check for first name
if ( empty($_POST['first_name']))
{ $errors[] = 'Enter your first name';}
else
{ $fn = mysqli_real_escape_string( $link, trim( $_POST['first_name']));}

//check for existing passwords and matching inputs
if( !empty($_POST['pass1']))
{
    if ( $_POST['pass1'] != $_POST['pass2'])
    { $errors[] = "Passwords do not match";}
    else
    { $p = mysqli_real_escape_string( $link, trim($_POST['pass1']));}
}
else { $errors[] = 'Enter your password';}

if (empty($errors))
{
    $q = "SELECT user_id FROM users WHERE email='$e'";
    $r = @mysqli_query ($link, $q);
    if ( mysqli_num_rows($r) != 0)
        $errors[]= 'Email address already registered. 
<a class="alert-link" href="login.php">Sign In Now</a>' ;
}
if (empty($errors))
{
    $q = "INSERT INTO users (first_name, last_name, email, pass, reg_date) VALUES ('$fn','$ln','$e','$p', NOW() )";
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