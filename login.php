<?php
session_start(); // Start a new session

// If the user is already logged in, redirect them to the home page
if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

// If the login form was submitted, process the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the username and password are correct
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // If the username and password are correct, store the user ID in the session and redirect to the home page
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        header("Location: index.php");
        exit;
    } else {
        // If the username and password are incorrect, display an error message
        echo "Invalid username or password.";
    }
}
?>
