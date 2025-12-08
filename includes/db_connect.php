<?php

$link = mysqli_connect ('localhost', 'root', '', 'ecommerce');
if (!$link) {
    die('could not connect: ' . mysqli_connect_error());
}

?>