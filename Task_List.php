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

// Fetch tasks from the database
$sql = "SELECT * FROM task_info";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #ff9a9e, #fad0c4);
            color: #333;
        }

        .container {
            max-width: 1200px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status-incomplete {
            color: red;
        }

        .status-in-progress {
            color: orange;
        }

        .status-complete {
            color: green;
        }
    </style>
</head>
<body>
<?php include 'Header.php'; ?>
    <div class="container">
        <h1>Task List Screen</h1>
        <table>
            <thead>
                <tr>
                    <th>Task ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $status_class = "";
                        $status_text = "";

                        // Determine status class and text
                        switch ($row["status"]) {
                            case 0:
                                $status_class = "status-incomplete";
                                $status_text = "To Do";
                                break;
                            case 1:
                                $status_class = "status-in-progress";
                                $status_text = "In Progress";
                                break;
                            case 2:
                                $status_class = "status-complete";
                                $status_text = "Done";
                                break;
                        }

                        echo "<tr>";
                        echo "<td>" . $row["task_id"] . "</td>";
                        echo "<td>" . $row["t_title"] . "</td>";
                        echo "<td>" . $row["t_description"] . "</td>";
                        echo "<td>" . $row["t_start_time"] . "</td>";
                        echo "<td>" . $row["t_end_time"] . "</td>";
                        echo "<td class='$status_class'>$status_text</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No tasks found</td></tr>";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
