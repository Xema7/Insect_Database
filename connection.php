<?php
    $server = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "clg";

    $conn = mysqli_connect($server, $dbuser, $dbpass, $dbname);

    if(!$conn){
        die("Connection error ". mysqli_connect_error());
    }
?>