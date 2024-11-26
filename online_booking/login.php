<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="static/img/favicon/favicon1.ico">
	<link rel="stylesheet" href="static/css/layout.css">
	<title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .login {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 15px 0 5px;
            color: #555;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"],
        button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover,
        button:hover {
            background-color: #555;
        }
        .section-buttons {
            display: flex;
            justify-content: center;
            gap: 10px; /* Adds space between the buttons */
        }
    </style>
</head>
<body>
	<?php include "navbar.php"; ?>
    <div class="login">
	<!-- login Page -->
	<section class="content-box">
		<form id="login" action="validate.php" method="post">
            <h1>Login</h1>
            <div>
                <label>Email Address</label>
                <input type="email" id="email" name="email" class="form-box" required>
            </div>
            <div>
                <label>Password</label>
                <input type="password" id="password" name="password" class="form-box" required>
            </div>
            <section class="section-buttons">
                <button type="submit" name="submit">Login</button>
                <button onclick="location.href='register.php'">Register</button>
            </section>
        </form>
	</section>
	</div>
</body>
</html>

<?php include "footer.php"; ?>
