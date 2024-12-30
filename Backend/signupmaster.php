<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "tms";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input data from the form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Perform the signup query for customer
    $sql = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Records saved successfully
        echo '<script>alert("Signup successful.");</script>';
        echo '<script>window.location.replace("http://localhost/Task_Management_System/index.php");</script>';
    } else {
        // Something went wrong
        echo '<script>alert("Something went wrong. Please try again.");</script>';
        echo '<script>window.location.replace("http://localhost/Task_Management_System/signup.php");</script>';
    }
}

// Close the database connection
mysqli_close($conn);
?>
