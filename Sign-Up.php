<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .main {
            width: 100%;
            background: linear-gradient(to bottom, pink, red);
            height: 109vh;
        }

        .navbar {
            width: 1200px;
            height: 75px;
            margin: auto;
        }

        .icon {
            width: 200;
            float: left;
            height: 70px;
        }

        .logo {
            color: orange;
            font-size: 35px;
            font-family: Arial, Helvetica, sans-serif;
            padding: 20px;
            float: left;
            padding-top: 10px;
        }

        .menu {
            width: 400px;
            float: left;
            height: 70px;
        }

        ul {
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        ul li {
            list-style: none;
            margin-left: 62px;
            margin-top: 27px;
            font-size: 14px;
        }

        ul li a {
            text-decoration: none;
            color: rgb(0, 0, 0);
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            transition: 0.4s ease-in-out;
        }

        ul li a:hover {
            color: #ff7200;
        }

        .content {
            width: 1200px;
            height: auto;
            margin: auto;
            color: antiquewhite;
            position: relative;
        }

        .content .para {
            padding-left: 20px;
            padding-bottom: 25px;
            font-family: Arial, Helvetica, sans-serif;
            letter-spacing: 1.2px;
            line-height: 30px;
        }

        .content h1 {
            font-family: 'Times New Roman', Times, serif;
            font-size: 50px;
            padding-left: 20px;
            margin-top: 9%;
            letter-spacing: 2px;
        }

        .content .btn {
            width: 160px;
            height: 40px;
            background-color: #ff7200;
            border: none;
            margin-bottom: 10px;
            margin-left: 20px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            transition: .4s ease;
        }

        .content .btn .a {
            text-decoration: none;
            color: #000;
            transition: 3s ease;
        }

        .btn:hover {
            background-color: #fff;
        }

        .content span {
            color: #ff7200;
            font-size: 60px;
        }

        .form {
            width: 250px;
            height: 400px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8)50%, rgba(0, 0, 0, 0.8)50%);
            position: absolute;
            top: -150px;
            left: 25%;
            transform: translate(50%, 50%);
            border-radius: 10px;
            padding: 25px;
        }

        .form h1 {
            width: 220px;
            font-family: sans-serif;
            text-align: center;
            color: #ff7200;
            font-size: 22px;
            background-color: #fff;
            border-radius: 10px;
            margin: 2px;
            padding: 8px;
        }

        .form input {
            width: 240px;
            height: 35px;
            background: transparent;
            border-bottom: solid #ff7200;
            border-top: none;
            border-left: none;
            border-right: none;
            color: #fff;
            font-size: 16px;
            letter-spacing: 1px;
            margin-top: 30px;
            font-family: sans-serif;
        }

        .form input:focus {
            outline: none;
        }

        ::placeholder {
            color: #fff;
            font-family: Arial, Helvetica, sans-serif;
        }

        .btn1 {
            width: 240px;
            height: 40px;
            background: #ff7200;
            border: none;
            margin-top: 30px;
            font-size: 18px;
            cursor: pointer;
            color: #fff;
        }

        .btn1:hover {
            background: #fff;
            color: #ff7200;
        }

        .content .btn1 .a {
            text-decoration: none;
            color: #000000;
            font-weight: bold;
        }

        .form .link {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 17px;
            padding-top: 20px;
            text-align: center;
        }

        .form .link .a {
            text-decoration: none;
            color: #ff7200;
        }

        .liw {
            padding-top: 15px;
            padding-bottom: 10px;
        }

        .form .signup-inputs {
            margin-top: 20px;
        }

        .form .signup-inputs input {
            width: 240px;
            height: 35px;
            background: transparent;
            border-bottom: solid #ff7200;
            border-top: none;
            border-left: none;
            border-right: none;
            color: #fff;
            font-size: 16px;
            letter-spacing: 1px;
            margin-top: 10px;
            font-family: sans-serif;
        }

        .form .signup-inputs select {
            width: 240px;
            height: 35px;
            background: transparent;
            border: solid #ff7200;
            color: #fff;
            font-size: 16px;
            letter-spacing: 1px;
            margin-top: 10px;
            font-family: sans-serif;
        }

        .form .signup-inputs input[type="password"] {
            margin-top: 10px;
        }

        .form .signup-buttons {
            margin-top: 20px;
        }

        .form .signup-buttons button {
            width: 100px;
            height: 40px;
            background: #ff7200;
            border: none;
            margin-top: 10px;
            margin-right: 10px;
            font-size: 18px;
            cursor: pointer;
            color: #fff;
            padding: auto;
        }

        .form .signup-buttons button:hover {
            background: #fff;
            color: #ff7200;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="content">
            <div class="form">
                <form action="Backend/signupmaster.php" method="post">
                    <h1>Sign Up</h1>
                    <div class="signup-inputs">
                        <input type="text" name="name" placeholder="Enter Your Name">
                        <input type="email" name="email" placeholder="Enter E-mail here">
                        <input type="password" name="password" placeholder="Create Password">
                        <input type="password" name="repassword" placeholder="Re-enter Password">
                    </div>
                    <div class="signup-buttons">
                        <button type="submit">Sign Up</button>
                        <button type="reset">Clear</button>
                    </div>
                    <p class="link">Already have an account?<br>
                        <a href="../Task_Management_System/index.php">Login here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
