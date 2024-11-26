const express = require('express');
const bodyParser = require('body-parser');
const app = express();
const port = 3000;
app.use(bodyParser.json());

app.post('/reservation', (req, res) => {
	const { roomGrade, checkIn, checkOut, emailAddress, totalCost } = req.body;
	console.log("receive reservation")
	const thankYouPage = `
	<!DOCTYPE html>
	<html lang="en">
	<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Thank You</title>
			<style>
					body {
							font-family: Arial, sans-serif;
							margin: 0;
							padding: 0;
							display: flex;
							justify-content: center;
							align-items: center;
							height: 100vh;
							background-color: #f9f9f9;
					}
					.container {
							text-align: center;
							padding: 20px;
							border: 1px solid #ddd;
							border-radius: 10px;
							background-color: #fff;
							box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
					}
					h1 {
							color: #007bff;
					}
					p {
							font-size: 16px;
							margin: 10px 0;
					}
					.button {
							display: inline-block;
							margin-top: 20px;
							padding: 10px 20px;
							color: white;
							background-color: #28a745;
							text-decoration: none;
							border-radius: 5px;
							font-size: 16px;
					}
					.button:hover {
							background-color: #218838;
					}
			</style>
	</head>
	<body>
			<div class="container">
					<h1>Thank You for Your Reservation!</h1>
					<p><strong>Room Grade:</strong> ${roomGrade}</p>
					<p><strong>Check-In:</strong> ${checkIn}</p>
					<p><strong>Check-Out:</strong> ${checkOut}</p>
					<p><strong>Email Address:</strong> ${emailAddress}</p>
					<p><strong>Total Cost:</strong> $${totalCost.toFixed(2)}</p>
					<a href="/" class="button">Go Back to Home</a>
			</div>
	</body>
	</html>
	`;
	// Respond to the PHP server
	res.send(thankYouPage);
});

app.listen(port, console.log(`Node.js server is running on http://localhost:${port}`));