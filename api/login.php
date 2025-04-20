<?php
session_start();
header("Content-Type: application/json");
require 'db.php'; // Database connection

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['name']) || empty(trim($data['name']))) {
    echo json_encode(["error" => "Username is required"]);
    exit();
}

if (!isset($data['password']) || strlen($data['password']) < 6) {
    echo json_encode(["error" => "Password must be at least 6 characters"]);
    exit();
}

$name = trim($data['name']);
$password = trim($data['password']);

// Check user credentials and fetch department & role details
$stmt = $conn->prepare("
    SELECT 
        u.id, u.name, u.email, u.password,  
        u.department_id, d.name AS department_name, 
        u.role_id, r.name AS role_name
    FROM users u
    JOIN departments d ON u.department_id = d.id
    JOIN roles r ON u.role_id = r.id
    WHERE u.name = ?
");
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Validate user existence
if (!$user) {
    echo json_encode(["error" => "Invalid username or password"]);
    exit();
}

// Store user data in session
$_SESSION['id'] = $user['id'];
$_SESSION['name'] = $user['name'];
$_SESSION['email'] = $user['email'];
$_SESSION['department_id'] = $user['department_id'];
$_SESSION['department_name'] = $user['department_name'];
$_SESSION['role_id'] = $user['role_id'];
$_SESSION['role_name'] = $user['role_name'];

// Determine user redirection
$role = strtolower(trim($user['role_name']));
if ($role === "admin") {
    $redirectUrl = "dashboard.php";
} elseif ($role === "visitor") {
    $redirectUrl = "visitorDashboard.php";
} else {
    $redirectUrl = "404Page.php";
}

// Return response
echo json_encode([
    "success" => true,
    "id" => $_SESSION['id'],
    "name" => $_SESSION['name'],
    "email" => $_SESSION['email'],
    "department_id" => $_SESSION['department_id'],
    "department_name" => $_SESSION['department_name'],
    "role_id" => $_SESSION['role_id'],
    "role_name" => $_SESSION['role_name'],
    "redirect" => $redirectUrl
]);
exit();
?>
