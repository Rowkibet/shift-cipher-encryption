<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'encrypt_file';

// establishes the connection to the db
$conn = new MySQLi($host, $user, $pass, $db_name);

// runs when connection fails and shows the error
if($conn->connect_error) {
    die('Database connection error ' . $conn->connect_error);
}