<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database="student_reg";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    else{
        // echo "connection was successful<br>";
    }

?>