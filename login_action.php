<?php
require('includes/db_connect.php');
require('login_tools.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    list($check, $data) = validate($link, $_POST['email'], $_POST['pass']);

    if ($check) {
        // Successful login
        session_start();
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['first_name'] = $data['first_name'];
        $_SESSION['last_name'] = $data['last_name'];
        load('index.php'); // redirect to homepage
    } else {
        // Unsuccessful login
        $errors = $data; 
        include('login.php');
    }

    mysqli_close($link);
}
?>