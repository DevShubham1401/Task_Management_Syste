<?php
// Start the session
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Get the input data from the form
    $email = $_POST["email"];
    $password = $_POST["pass"];

    // Prepare a SQL query to check the user's credentials
    $sql = "SELECT * FROM user WHERE email = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if the query returned any rows
    if (mysqli_num_rows($result) == 1) {
        // Get the user's data
        $row = mysqli_fetch_assoc($result);

        // Store the user's email in the session
        $_SESSION['email'] = $row['email'];

        // Redirect to Task List
        header("Location: http://localhost/Task_Management_System/Task_List.php");
        exit();
    } else {
        // Authentication failed, redirect to the login page with an error message
        echo '<script>alert("Invalid email or password. Please try again.");</script>';
        echo '<script>window.location.replace("http://localhost/Task_Management_System/index.php");</script>';
        exit();
    }

    // Close statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
