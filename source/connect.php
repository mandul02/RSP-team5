<?php
$connection = mysqli_connect('localhost', 'czteam5', 'teampet');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'czteam5');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}