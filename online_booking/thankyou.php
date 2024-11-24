<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="static/img/favicon/favicon.ico">
	<link rel="stylesheet" href="static/css/layout.css">
	<title>Booking Complete!</title>
	<style>
		*{
		box-sizing:border-box;
		}
		body{
		background: #ffffff;
		background: linear-gradient(to bottom, #ffffff 0%,#e1e8ed 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e1e8ed',GradientType=0 );
			height: 100%;
				margin: 0;
				background-repeat: no-repeat;
				background-attachment: fixed;
		
		}

		.wrapper-1{
		width:100%;
		height:100vh;
		display: flex;
		flex-direction: column;
		}
		.wrapper-2{
		padding :30px;
		text-align:center;
		}
		h1{
			font-family: 'Kaushan Script', cursive;
		font-size:4em;
		letter-spacing:3px;
		color:#181818 ;
		margin:0;
		margin-bottom:20px;
		}
		.wrapper-2 p{
		margin:0;
		font-size:1.3em;
		color:#aaa;
		font-family: 'Source Sans Pro', sans-serif;
		letter-spacing:1px;
		}
		.go-home{
		color:#fff;
		background:#181818;
		border:none;
		padding:10px 50px;
		margin:30px 0;
		border-radius:30px;
		text-transform:capitalize;
		box-shadow: 0 10px 16px 1px rgba(50, 46, 61, 0.2);
		}
		.footer-like{
		margin-top: auto; 
		background:#f1f1f1;
		padding:6px;
		text-align:center;
		}
		.footer-like p{
		margin:0;
		padding:4px;
		color:#252525;
		font-family: 'Source Sans Pro', sans-serif;
		letter-spacing:1px;
		}
		.footer-like p a{
		text-decoration:none;
		color:#5892FF;
		font-weight:600;
		}

		@media (min-width:360px){
		h1{
			font-size:4.5em;
		}
		.go-home{
			margin-bottom:20px;
		}
		}

		@media (min-width:600px){
		.content{
		max-width:1000px;
		margin:0 auto;
		}
		.wrapper-1{
		height: initial;
		max-width:620px;
		margin:0 auto;
		margin-top:50px;
		box-shadow: 4px 8px 40px 8px rgba(50, 46, 61, 0.2);
		margin-bottom:50px;
		}
		
}
	</style>
</head>
<body>
	<?php include "navbar.php"; ?>
	<div class=content>
		<div class="wrapper-1">
			<div class="wrapper-2">
			<h1>Thank you !</h1>
			<p>Details will be sent to your email, </p>
			<p>feel free to contact info@DreamcatcherPalace.com  </p>
			<a href="home.php" >
				<button class="go-home">
					Home Page
				</button>
			</a>
			</div>
			<div class="footer-like">
			<p>Booking ID: <?php echo $bookingID; ?> </p>
			<p>Room Number: <?php echo $roomNumbre; ?> </p>
			<p>Check In Date: <?php echo $reservedStartDate	; ?> </p>
			<p>Check Out Date: <?php echo $reservedEndDate; ?> </p>
			</div>
		</div>
	</div>
	<?php include "footer.php"; ?>
</body>
</html>
