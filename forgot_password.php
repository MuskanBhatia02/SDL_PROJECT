<?php
// If the form was submitted, send a password reset email to the user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $email = $_POST["email"];

    // Generate a password reset token
    $token = bin2hex(random_bytes(32));

    // Insert the token into the database
    $query = "INSERT INTO password_resets (email, token) VALUES ('$email', '$token')";
    mysqli_query($conn, $query);

    // Send a password reset email to the user
    $subject = "Password Reset Request";
    $message = "Click the following link to reset your password: http://example.com/reset_password.php?email=$email&token=$token";
    mail($email, $subject, $message);

    // Display a confirmation message to the user
    echo "An email has been sent to your email address with instructions on how to reset your password.";
}
?>
<form method="post">
    <label>Email:</label>
    <input type="email" name="email"><br>

    <input type="submit" value="Reset Password">
</form>
