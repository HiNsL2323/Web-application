<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="img/favicon/favicon.ico">
	<link rel="stylesheet" href="css/layout.css">
	<title>Login</title>
</head>
<body>
	<?php include "navbar.php"; ?>

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
            <section>
                <button type="submit" name="submit">Login</button>
                <button onclick="location.href='register.php'">Register</button>
            </section>
        </form>
	</section>
	
</body>
</html>

<?php include "footer.php"; ?>