<?php
session_start(); // Start a new session

// If the user is not logged in, redirect them to the login page
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

// If the form was submitted, update the user data in the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Update the user data in the database
    $user_id = $_SESSION["user_id"];
    $query = "UPDATE users SET username='$username', email='$email', password='$password' WHERE id=$user_id";
    mysqli_query($conn, $query);

    // Display a confirmation message to the user
    echo "Your profile has been updated.";
}

// Retrieve the user data from the database
$user_id = $_SESSION["user_id"];
$query = "SELECT * FROM users WHERE id=$user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>
<form method="post">
    <label>Username:</label>
    <input type="text" name="username" value="<?php echo $user["username"]; ?>"><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $user["email"]; ?>"><br>

    <label>Password:</label>
    <input type="password" name="password"><br>

    <input type="submit" value="Update Profile">
</form>
