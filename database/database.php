<?php
    $servername = "localhost";
    $db_name = "ipt2_midterm_project";
    $username = "root";
    $password = "";

    
    $conn=  new mysqli($servername, $username, $password, $db_name);

    
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_server);
    }
    echo "Connected";

    $query = "SELECT * FROM books ORDER BY id ASC";

    $counter = 1;

?>