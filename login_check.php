<?php

$host = "localhost";
$user = "Filzah";
$password = "Password123";
$db = "student_portal";

$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize inputs to prevent SQL injection
    $username = mysqli_real_escape_string($data, $username);
    $password = mysqli_real_escape_string($data, $password);

    // Query to check user credentials
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($data, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Check usertype and redirect
        if ($row['usertype'] == 'admin') {
            $_SESSION['username'] = $username;
            $_SESSION['usertype'] = 'admin';
            header("Location: adminhome.php");
        } elseif ($row['usertype'] == 'student') {
            $_SESSION['username'] = $username;
            $_SESSION['usertype'] = 'student';
            header("Location: studenthome.php");
        } else {
            $_SESSION['error'] = "Invalid usertype.";
            header("Location: login.php");
        }
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: login.php");
    }
    exit();
}
?>
