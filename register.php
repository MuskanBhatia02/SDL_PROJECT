<?php
session_start(); // Start a new session

// If the user is already logged in, redirect them to the home page
if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

// If the registration form was submitted, process the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Insert the user data into the database
    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    mysqli_query($conn, $query);

    // Store the user ID in the session and redirect to the home page
    $_SESSION["user_id"] = mysqli_insert_id($conn);
    $_SESSION["username"] = $username;
    header("Location: index.php");
    exit;
}
?>
