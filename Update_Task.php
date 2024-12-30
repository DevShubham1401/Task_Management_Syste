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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update/Delete Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #ff9a9e, #fad0c4);
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
        }

        button.delete {
            background-color: #d9534f;
        }

        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
<?php include 'Header.php'; ?>
    <div class="container">
        <h1>Update/Delete Task</h1>
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
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
