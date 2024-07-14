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
    if ($conn->query($sql) != TRUE) {
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

    $sql1 = "CREATE TABLE IF NOT EXISTS posts (
      pid INT PRIMARY KEY AUTO_INCREMENT,
      uid INT NOT NULL,
      Area VARCHAR(50) NOT NULL,
      Full_address VARCHAR(250) NOT NULL,
      type VARCHAR(250) NOT NULL,
      amount VARCHAR(50) NOT NULL,
      short_description VARCHAR(50) null,
      status VARCHAR(50) NOT NULL,
      Expire_date DATE NOT NULL,
      photo VARCHAR(50) null
  )";

  $sql2= "CREATE TABLE IF NOT EXISTS employees (
    eid INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    Area VARCHAR(50) NOT NULL,
    Detail_address VARCHAR(250) NOT NULL,
    email VARCHAR(50) NOT NULL,
    Payment_status VARCHAR(50) null,
    phone VARCHAR(50) NOT NULL,
    optional_num VARCHAR(50) NOT NULL  
)";

    if ($conn->query($sql) != TRUE) {
      echo "Error creating table: " . $conn->error;
    }
    if ($conn->query($sql1) != TRUE) {
      echo "Error creating table: " . $conn->error;
    } 
    if ($conn->query($sql2) != TRUE) {
        echo "Error creating table: " . $conn->error;
      } 

    // Close connection
    $conn->close();

?>