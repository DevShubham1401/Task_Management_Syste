<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #ff9a9e, #fad0c4);
            color: #333;
        }

        .container {
            max-width: 800px;
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

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
<?php include 'Header.php'; ?>

    <div class="container">
        <h1>Create New Task</h1>
        <form method="POST" action="Backend/createmaster.php">
            <label for="title">Task Title</label>
            <input type="text" id="title" name="t_title" required>

            <label for="description">Task Description</label>
            <textarea id="description" name="t_description" rows="4" required></textarea>

            <label for="start_time">Start Time</label>
            <input type="datetime-local" id="start_time" name="t_start_time" required>

            <label for="end_time">End Time</label>
            <input type="datetime-local" id="end_time" name="t_end_time" required>

            <label for="status">Task Status</label>
            <select id="status" name="status" required>
                <option value="0">To Do</option>
                <option value="1">In Progress</option>
                <option value="2">Done</option>
            </select>

            <button type="submit">Create Task</button>
        </form>
    </div>

</body>
</html>
