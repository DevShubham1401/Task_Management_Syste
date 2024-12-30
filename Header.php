<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header File</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .main {
            width: 100%;
            background-position: center;
            background-size: cover;
            /* background-color: #00b2ce; */
        }

        .navbar {
            width: 95%;
            /* background-color: #f2f2f2; */
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .icon {
            display: flex;
            align-items: center;
        }

        .logo {
            color: yellow;
            font-size: 35px;
            font-family: 'Times New Roman', Times, serif;
            margin-right: auto;
            
        }

        .menu {
            display: flex;
            align-items: center;
        }

        ul {
            display: flex;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        ul li {
            margin-left: 20px;
        }

        ul li:first-child {
            margin-left: 0;
        }

        ul li a {
            text-decoration: none;
            color: #00b2ce;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            transition: 0.4s ease-in-out;
        }

        ul li a:hover {
            color: #ff7200;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="icon">
            <h1 class="logo">Task Management System</h1>
        </div>
        <div class="menu">
            <ul>
                <li><a href="Create_Task.php">Create Task</a></li>
                <li><a href="Task_List.php">View Task</a></li>
                <li><a href="Update_Task.php">Update Task</a></li>
                <li><a href="logout.php">LOGOUT</a></li>
            </ul>
        </div>
    </div>
    
</body>

</html>