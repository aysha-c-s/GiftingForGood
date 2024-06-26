<?php
     $servername = "localhost"; // Replace with your server name
     $username = "root"; // Replace with your MySQL username
     $password = ""; // Replace with your MySQL password
     $dbname = "donations";
 
     // Create connection
     $conn = new mysqli($servername, $username, $password);
 
     // Check connection
    if ($conn->connect_error) {
        die("DB Connection failed: " . $conn->connect_error);
    } 
    
    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === TRUE) {
        echo "Database created!<br>";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    // Close connection to create a new one for the database
    $conn->close();

    // Create connection to the new database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to create table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        uid INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(50) NOT NULL,
        address VARCHAR(250) NOT NULL,
        phone VARCHAR(50) NOT NULL,
        optional_num VARCHAR(50) null,
        email VARCHAR(50) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Students table created!<br>";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // Close connection
    $conn->close();

?>