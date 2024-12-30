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

// Process the form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form
    $title = $_POST['t_title'];
    $description = $_POST['t_description'];
    $start_time = $_POST['t_start_time'];
    $end_time = $_POST['t_end_time'];
    $status = $_POST['status'];

    // Insert the new task into the database
    $sql = "INSERT INTO task_info (t_title, t_description, t_start_time, t_end_time, status) 
            VALUES ('$title', '$description', '$start_time', '$end_time', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Task created successfully...");</script>';
        echo '<script>window.location.replace("http://localhost/Task_Management_System/Create_Task.php");</script>';

    } else {
        echo '<script>alert("Something went wrong. Please try again.");</script>';
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
