<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="img/favicon/favicon.ico">
	<link rel="stylesheet" href="css/layout.css">
	<title>Contact us</title>
	<style>
		* {
			box-sizing: border-box;
		}

		/* Style inputs */
		input[type=text],
		input[type=email],
		textarea {
			width: 100%;
			padding: 12px;
			border: 1px solid #ccc;
			margin-top: 6px;
			margin-bottom: 16px;
			resize: vertical;
		}

		input[type=submit] {
			/* background-color: #04AA6D;
			color: white;
			padding: 12px 20px;
			border: none;
			cursor: pointer; */
			background-color: #222;
			color: #ffffff;
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			font-size: 16px;
			cursor: pointer;
		}

		input[type=submit]:hover {
			background-color: #757575;
		}

		.container {
			border-radius: 5px;
			background-color: #f2f2f2;
			padding: 10px;
		}

		.column {
			float: left;
			width: 50%;
			margin-top: 6px;
			padding: 20px;
		}

		.row:after {
			content: "";
			display: table;
			clear: both;
		}
	</style>
</head>

<body>
	<?php include "navbar.php"; ?>
	<div class="main">
		<div class="container">
			<div class="row">
				<div class="column">
					<img src="img/widget/frontdesk.jpg" style="width:100%">
				</div>
				<div class="column">
					<form action='#.php' method='POST'>
						<label for="firstname">First Name</label>
						<input type="text" id="firstname" name="firstname" placeholder="Your name..">
						<label for="lastname">Last Name</label>
						<input type="text" id="lastname" name="lastname" placeholder="Your last name..">
						<label for="email">Email</label>
						<input type="email" id="email" name="email" placeholder="Your email">
						<label for="comment">Comment</label>
						<textarea id="comment" name="comment" placeholder="Please leave a comment for us." style="height:170px"></textarea>
						<input type="submit" value="Submit">
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include "footer.php"; ?>
</body>

</html>