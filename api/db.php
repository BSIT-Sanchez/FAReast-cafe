<?php
$servername = "Localhost";
$username = "admin_ManangSy"; // Your database username
$password = "BxfnwLbaIi0HFbHb"; // Your database password
$dbname = "admin_Administrative"; // Your database name
$socket = '/run/mysqld/mysqld.sock';

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname, null, $socket);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}
?>