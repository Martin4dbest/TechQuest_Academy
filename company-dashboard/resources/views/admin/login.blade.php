<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .login-form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-form input[type="text"], .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
        }
        .login-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .login-form input[type="submit"]:hover {
            background-color: #444;
        }
    </style>
</head>
<body>
    <h1>Admin Login</h1>
    <div class="login-form">
        <form>
            <input type="text" placeholder="Username" name="username"><br>
            <input type="password" placeholder="Password" name="password"><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>