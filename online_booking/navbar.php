<?php
session_start();

// Connect to database
include 'DBconn.php';

// Select all room category
$sql = "SELECT * FROM room_details ORDER BY roomPrice DESC";
$result = mysqli_query($conn, $sql);

// Close database connection
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="static/img/favicon/favicon.ico">
	<link rel="stylesheet" href="static/css/layout.css">
	<title>Dreamcatcher Palace</title>
	<style>
		* {
			padding: 0;
			margin: 0;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			text-decoration: none;
			font-family: arial, tahoma;
			list-style: none;
		}

		header {
			background-color: #333;
			height: 500px;
		}

		.navbar {
			display: flex;
			background-color: #222;
			justify-content: center;
		}

		nav {
			width: 80%;
			background-color: #222;
			border-bottom: 1px solid #555;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.logo {
			padding: 10px;
			width: auto;
			float: left;
		}

		.logo img {
			height: 55px;
		}

		.cart {
			/* top: 10px; */
			/* float: right; */
			width: 100px;
		}

		.cart img {
			height: 25px;
		}

		.list-item {
			padding: 0;
			list-style: none;
			display: table;
			width: 500px;
			text-align: center;
		}

		.list-item li {
			display: table-cell;
			position: relative;
			padding: 15px 0;
		}

		.list-item li a {
			color: #fff;
		}

		.list-item li a:after {
			background: none repeat scroll 0 0 transparent;
			bottom: 0;
			content: "";
			display: block;
			height: 2px;
			left: 50%;
			position: absolute;
			background: #fff;
			transition: width 0.3s ease 0s, left 0.3s ease 0s;
			width: 0;
		}

		.list-item li a:hover:after {
			width: 100%;
			left: 0;
		}

		.dropdown {
			position: relative;
			z-index: 1000;
		}

		.dropdown-menu {
			display: none;
			position: absolute;
			top: 100%;
			left: 0;
			background-color: #222;
			padding: 10px;
			z-index: 1000;
			min-width: 150px;
			text-align: left;
		}

		.dropdown:hover .dropdown-menu {
			display: grid;
		}

		.dropdown-menu li {
			margin: 5px 0;
		}

		.dropdown-menu li a {
			color: #fff;
			text-decoration: none;
			text-transform: capitalize;
			margin-right: 5px;
			text-align: center;
			padding: 20px;
			width: 10%;
			box-sizing: border-box;
		}
	</style>
</head>

<body>
	<span class="navbar">
		<nav>
			<div class="logo">
				<a href="home.php"><img src="static/img/shopline/logo.png" /></a>
			</div>

			<ul class="list-item">
				<li><a href="home.php">Home</a></li>
				<li class="dropdown">
					<a href="rooms.php">Rooms</a>
					<ul class="dropdown-menu">
						<?php
						if (mysqli_num_rows($result) > 0) {
							while ($navRow = mysqli_fetch_assoc($result)) {
								echo "<li><a href='rooms.php?roomGrade={$navRow['roomGrade']}'>{$navRow['roomGrade']}</a></li>";
							}
						}
						?>
					</ul>
				</li>
				<li><a href="reservation.php?roomGrade=Presidential">Reservation</a></li>
				<li><a href="contact_us.php">Contact us</a></li>
				<li class="dropdown">
						<?php
							if (isset($_SESSION['loginUser'])) {
								echo "<a>" . $_SESSION['loginUser'] . "</a>";
								echo "<ul class='dropdown-menu'>
									<li>
										<a href='my_member_page.php'>My Member</a>
									</li>
									<li>
										<a href='my_booking_page.php'>My Booking</a>
									</li>
									<li>
										<a href='logout.php'>Logout</a>
									</li>
								</ul>";
							} else {
								echo "<a href='login.php'>Login</a>";
							}?>
				
				</li>
		</nav>
	</span>

</body>

</html>
