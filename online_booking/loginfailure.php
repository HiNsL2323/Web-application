<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="static/img/favicon/favicon1.ico">
    <link rel="stylesheet" href="static/css/layout.css">
    <title>Login Failure</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .login_fail {
            max-width: 600px;
            margin: 50px auto;
            padding: 10px 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            text-align: center;
        }
        h1 {
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
        }
        h2 {
            color: #555;
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        button {
            width: 80%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="login_fail">
        <h1>Sorry, login failed.</h1>
        <h2>Invalid Email or Password!</h2>
        <button onclick="location.href='home.php'">Back to Home</button>
    </div>

    <?php include "footer.php"; ?>
</body>
</html>
