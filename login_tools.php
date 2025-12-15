<?php


function load($page = 'login.php') {
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    $url = rtrim($url, '/\\') . '/' . $page;
    header("Location: $url");
    exit();
}

function validate($link, $email = '', $pwd = '') {
    $errors = array();

    if (empty($email)) {
        $errors[] = 'Enter your email address.';
    } else {
        $e = mysqli_real_escape_string($link, trim($email));
    }

    if (empty($pwd)) {
        $errors[] = 'Enter your password.';
    } else {
        $p = trim($pwd);
    }

    if (empty($errors)) {
        $q = "SELECT user_id, first_name, last_name, pass FROM users WHERE email='$e'";
        $r = mysqli_query($link, $q);

        if (mysqli_num_rows($r) == 1) {
            $row = mysqli_fetch_assoc($r);
            if (password_verify($p, $row['pass'])) {
                return array(true, $row);
            } else {
                $errors[] = 'The email or password is incorrect.';
            }
        } else {
            $errors[] = 'The email or password is incorrect.';
        }
    }

    return array(false, $errors);
}
?>