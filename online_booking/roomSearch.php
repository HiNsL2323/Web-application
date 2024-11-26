<?php

include "navbar.php";
include 'DBconn.php';

$roomGrade = $_POST['roomGrade'];
$reservedStartDate = $_POST['reservedStartDate'];
$reservedEndDate = $_POST['reservedEndDate'];
$reservedStartTime = $_POST['reservedStartTime'];
$reservedEndTime = $_POST['reservedEndTime'];
$emailAddress = $_POST['emailAddress'];
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="static/img/favicon/favicon1.ico">
	<link rel="stylesheet" href="static/css/roomDetail.css">
	<title>Reserve</title>
</head>

<body>
	<?php
	// Validate
	if (!$roomGrade || !$reservedStartDate || !$reservedEndDate || !$reservedStartTime || !$reservedEndTime || !$emailAddress) {
		echo "All fields are required!";
		exit();
	}

	$checkIn = $reservedStartDate . ' ' . $reservedStartTime;
	$checkOut = $reservedEndDate . ' ' . $reservedEndTime;

	// Check if a reservation already exists
	$checkSql = "SELECT * FROM reservation WHERE roomGrade = ? AND (checkIn < ? AND checkOut > ?)";
	$checkStmt = $conn->prepare($checkSql);
	$checkStmt->bind_param("sss", $roomGrade, $checkOut, $checkIn);
	$checkStmt->execute();
	$result = $checkStmt->get_result();

	if ($result->num_rows > 0) {
		echo "The selected room is already reserved for the specified time range.";
		exit();
	}

	// Fetch roomPrice from room_details table
	$priceSql = "SELECT roomPrice FROM room_details WHERE roomGrade = ?";
	$priceStmt = $conn->prepare($priceSql);
	$priceStmt->bind_param("s", $roomGrade);
	$priceStmt->execute();
	$priceResult = $priceStmt->get_result();

	if ($priceResult->num_rows === 0) {
		echo "Invalid room grade selected.";
		exit();
	}

	$roomDetails = $priceResult->fetch_assoc();
	$roomPrice = $roomDetails['roomPrice'];

	$checkInDateTime = new DateTime($checkIn);
	$checkOutDateTime = new DateTime($checkOut);
	$interval = $checkInDateTime->diff($checkOutDateTime);
	$totalDays = $interval->days;

	// Calculate total cost
	$totalCost = $totalDays * $roomPrice;

	// Insert reservation data into the MySQL database
	$sql = "INSERT INTO reservation (roomGrade, checkIn, checkOut, emailAddress, totalCost) VALUES (?, ?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssssd", $roomGrade, $checkIn, $checkOut, $emailAddress, $totalCost);

	if ($stmt->execute()) {
		echo "Reservation successfully saved!";

		$reservationData = [
			"roomGrade" => $roomGrade,
			"checkIn" => $checkIn,
			"checkOut" => $checkOut,
			"emailAddress" => $emailAddress,
			"totalCost" => $totalCost,
		];

		sendToNodeJs($reservationData);
	} else {
		echo "Error saving reservation: " . $stmt->error;
	}

	// Function to send data to the Node.js server
	function sendToNodeJs($data)
	{
		$url = 'http://localhost:3000/reservation'; // Replace with your Node.js server URL
		$options = [
			'http' => [
				'header' => "Content-type: application/json\r\n",
				'method' => 'POST',
				'content' => json_encode($data)
			]
		];
		$context = stream_context_create($options);
		$result = @file_get_contents($url, false, $context);
		if ($result === FALSE) {
			echo "Error sending data to Node.js server.";
		} else {
			$response = json_decode($result, true);
			if ($response && isset($response['message'])) {
				echo htmlspecialchars($response['message']); // Display the response message
			} else {
				echo "Data sent to Node.js server successfully, but no html received.";
			}
		}
	}

	$checkStmt->close();
	$priceStmt->close();
	$stmt->close();
	$conn->close();
	?>
	<?php include "footer.php"; ?>
</body>

</html>
