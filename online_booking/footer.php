<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="static/img/favicon/favicon1.ico">
	<link rel="stylesheet" href="static/css/layout.css">
	<style>
		body {
			font-family: 'Alegreya Sans', sans-serif;
		}

		/* Sticky footer position and size
-------------------------------------------------- */

		.footer {
			display: flex;
			background-color: #222;
			justify-content: space-evenly;
			align-items: center;
			padding-top: 70px;
			padding-bottom: 70px;
			color: #fff;
			font-family: 'Nunito', sans-serif;
		}

		.footer .footer-box {
			text-align: center;
		}

		.footer .footer-text {
			margin-top: 10px;
			margin-bottom: 20px;
			font-family: 'Open Sans', sans-serif;
		}

		.text-small {
			font-size: 15px;
		}

		.footer-icon-list {
			display: flex;
			justify-content: space-evenly;
		}

		.footer-icon-list img {
			width: 20px;
		}

		.footer-icon-list a {
			text-decoration: none;
		}

		footer a:hover,
		footer a:focus {
			color: #aaa;
			text-decoration: none;
			border-bottom: 1px dotted #999;
		}

		footer .form-control {
			background-color: #1f2022;
			box-shadow: 0 1px 0 0 rgba(255, 255, 255, 0.1);
			border: none;
			resize: none;
			color: #d1d2d2;
			padding: 0.7em 1em;
		}

		.footer-logo {
			margin-bottom: 20px;
		}

		.footer-logo img {
			width: 250px;
		}

		.logo-text {
			font-size: 25px;
			font-style: italic;
			font-weight: bold;
		}

		.email-input {
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 4px;
			font-size: 16px;
		}

		.subscribe-button {
			background-color: #ffcc00;
			color: #ffffff;
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			font-size: 16px;
			cursor: pointer;
		}

		.subscribe-button:hover {
			background-color: #ff9900;
		}
	</style>

	<title>Dreamcatcher Palace</title>
</head>

<body>
	<div class="container">
		<footer class="footer">
			<div class="footer-box">
				<div class="footer-text">Phone +852 98765432</div>
				<div class="footer-text">info@DreamcatcherPalace.com</div>
				<div class="footer-icon-list">
					<a href="#"><img src="static/img/widget/facebook.svg" alt="facebook-btn" /></a>
					<a href="#"><img src="static/img/widget/instagram.svg" alt="instagram-btn" /></a>
					<a href="#"><img src="static/img/widget/twitter.svg" alt="twitter-btn" /></a>
					<a href="#"><img src="static/img/widget/google-plus-g.svg" alt="google-plus-g-btn" /></a>
				</div>
			</div>
			<div class="footer-box">
				<div class="footer-logo"><img src="static/img/logo/logo_dream.png" /></div>
				<div class="logo-text">Dreamcatcher Palace</div>
			</div>
			<div class="footer-box">
				<div class="footer-text">Catch your Dream in our Palace</div>
				<div class="footer-text text-small">Subscribe to our newsletter</br> for future promotion and more</div>
				<div id="email-box">
					<input type="email" name="email" placeholder="Enter your email address" class="email-input">
					<button style="margin:0px" type="submit" onclick="updateContent()" class="subscribe-button">Subscribe</button>
				</div>
				<div id="content"></div>

				<script>

					function updateContent() {
						const emailInput = document.querySelector('.email-input');
						const contentDiv = document.getElementById('content');
						const emailBoxDiv = document.getElementById('email-box');
						const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

						const email = emailInput.value;
						if (emailPattern.test(email)) {
							contentDiv.innerHTML = `Thank you for subscribing with email: ${email}`;
							emailBoxDiv.style.display = 'none';
						}else{
							contentDiv.innerHTML =''
							contentDiv.innerHTML ='Invalid email address!'
						}
					}
				</script>
				<!-- </form> -->
			</div>

		</footer>
	</div>

</body>

</html>
