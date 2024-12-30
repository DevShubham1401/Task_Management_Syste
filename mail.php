<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "tms";

// Start session to access user information
session_start();

// Assume the user's email is stored in the session after login
$logged_in_user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null;

if (!$logged_in_user_email) {
    die("Error: User email not found. Please log in.");
}

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to send email
function sendStatusEmail($to, $subject, $message) {
    $headers = "From: no-reply@tms.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    return mail($to, $subject, $message, $headers);
}

// Handle form submission to update task status
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
    $task_id = $_POST["task_id"];
    
    if ($_POST["action"] === "update" && isset($_POST["status"])) {
        $status = $_POST["status"];

        // Update task status in the database
        $sql = "UPDATE task_info SET status = ? WHERE task_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $status, $task_id);

        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Task status updated successfully.");</script>';

            // Send email to the logged-in user
            $status_map = [0 => 'To Do', 1 => 'In Progress', 2 => 'Done'];
            $task_title_query = "SELECT t_title FROM task_info WHERE task_id = ?";
            $task_stmt = mysqli_prepare($conn, $task_title_query);
            mysqli_stmt_bind_param($task_stmt, "i", $task_id);
            mysqli_stmt_execute($task_stmt);
            mysqli_stmt_bind_result($task_stmt, $task_title);
            mysqli_stmt_fetch($task_stmt);

            $subject = "Task Status Updated";
            $message = "
                <h2>Task Status Updated</h2>
                <p><strong>Task:</strong> $task_title</p>
                <p><strong>New Status:</strong> " . $status_map[$status] . "</p>
                <p>Thank you for using our Task Management System.</p>
            ";

            sendStatusEmail($logged_in_user_email, $subject, $message);

            mysqli_stmt_close($task_stmt);
        } else {
            echo '<script>alert("Something went wrong. Please try again.");</script>';
            echo "<p>Error updating task status: " . mysqli_error($conn) . "</p>";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    if ($_POST["action"] === "delete") {
        // Delete task from the database
        $sql = "DELETE FROM task_info WHERE task_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $task_id);

        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Task deleted successfully.");</script>';
        } else {
            echo '<script>alert("Failed to delete the task. Please try again.");</script>';
            echo "<p>Error deleting task: " . mysqli_error($conn) . "</p>";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

// Fetch tasks for the dropdown
$sql = "SELECT task_id, t_title FROM task_info";
$result = mysqli_query($conn, $sql);

// Functionality for creating a new task
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_task"])) {
    $t_title = $_POST["t_title"];
    $status = 0; // Default status: To Do

    // Insert new task into the database
    $sql = "INSERT INTO task_info (t_title, status) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $t_title, $status);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Task created successfully.");</script>';

        // Send email to the logged-in user
        $subject = "New Task Created";
        $message = "
            <h2>New Task Created</h2>
            <p><strong>Task:</strong> $t_title</p>
            <p><strong>Status:</strong> To Do</p>
            <p>Thank you for using our Task Management System.</p>
        ";

        sendStatusEmail($logged_in_user_email, $subject, $message);
    } else {
        echo '<script>alert("Failed to create the task. Please try again.");</script>';
        echo "<p>Error creating task: " . mysqli_error($conn) . "</p>";
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update/Delete Task</title>
    <style>
        /* Add the existing styles here */
    </style>
</head>
<body>
<?php include 'Header.php'; ?>
    <div class="container">
        <h1>Manage Tasks</h1>
        <form method="POST" action="">
            <label for="task_id">Select Task</label>
            <select name="task_id" id="task_id" required>
                <option value="">-- Select Task --</option>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['task_id'] . "'>" . $row['t_title'] . "</option>";
                    }
                }
                ?>
            </select>

            <label for="status">Select Status</label>
            <select name="status" id="status">
                <option value="">-- Select Status --</option>
                <option value="0">To Do</option>
                <option value="1">In Progress</option>
                <option value="2">Done</option>
            </select>

            <button type="submit" name="action" value="update">Update Status</button>
            <button type="submit" name="action" value="delete" class="delete">Delete Task</button>
        </form>

        <hr>

        <h2>Create New Task</h2>
        <form method="POST" action="">
            <label for="t_title">Task Title</label>
            <input type="text" id="t_title" name="t_title" required>

            <button type="submit" name="create_task">Create Task</button>
        </form>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
