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
	<link rel="icon" type="image/x-icon" href="static/img/favicon/favicon.ico">
	<link rel="stylesheet" href="static/css/roomDetail.css">
	<title>Reserve</title>
	<style>
		.warning-message {
		    margin: 20px auto;
		    padding: 15px;
		    max-width: 600px;
		    text-align: center;
		    background-color: #f8d7da;
		    color: #721c24; 
		    border: 1px solid #f5c6cb;
		    border-radius: 5px;
		    font-family: Arial, sans-serif;
		    font-size: 16px;
		}

		.back-btn {
		    margin-top: 10px;
		    padding: 10px 20px;
		    background-color: #333;
		    color: #fff;
		    border: none;
		    border-radius: 5px;
		    cursor: pointer;
		    font-size: 16px;
		    transition: background-color 0.3s ease;
		}

		.back-btn:hover {
		    background-color: #555;
		}
	</style>
</head>

<body>
	<?php
	// Validate
	if (!$roomGrade || !$reservedStartDate || !$reservedEndDate || !$reservedStartTime || !$reservedEndTime || !$emailAddress) {
		echo "
		<div class='warning-message'>
			<p>All fields are required</p>
			<button class='back-btn' onclick='history.back()'>Go Back</button>
		</div>";
		include "footer.php";
		return;
	}

	$checkIn = $reservedStartDate . ' ' . $reservedStartTime;
	$checkOut = $reservedEndDate . ' ' . $reservedEndTime;

	$checkSql = "SELECT * FROM reservation WHERE roomGrade = ? AND (checkIn < ? AND checkOut > ?)";
	$checkStmt = $conn->prepare($checkSql);
	$checkStmt->bind_param("sss", $roomGrade, $checkOut, $checkIn);
	$checkStmt->execute();
	$result = $checkStmt->get_result();

	if ($result->num_rows > 0) {
		echo "
		<div class='warning-message'>
			<p>Sorry, the selected room is already reserved for the specified time range.</p>
			<button class='back-btn' onclick='history.back()'>Go Back</button>
		</div>";
		include "footer.php";
		return;
	}

	$priceSql = "SELECT roomPrice FROM room_details WHERE roomGrade = ?";
	$priceStmt = $conn->prepare($priceSql);
	$priceStmt->bind_param("s", $roomGrade);
	$priceStmt->execute();
	$priceResult = $priceStmt->get_result();

	if ($priceResult->num_rows === 0) {
		echo "
		<div class='warning-message'>
			<p>Invalid room grade selected.</p>
			<button class='back-btn' onclick='history.back()'>Go Back</button>
		</div>";
		include "footer.php";
		return;
	}

	$roomDetails = $priceResult->fetch_assoc();
	$roomPrice = $roomDetails['roomPrice'];

	$checkInDateTime = new DateTime($checkIn);
	$checkOutDateTime = new DateTime($checkOut);
	$interval = $checkInDateTime->diff($checkOutDateTime);
	$totalDays = $interval->days;
	if ($checkInDateTime->diff($checkOutDateTime)->h > 0 || $checkInDateTime->diff($checkOutDateTime)->i > 0) {
		$totalDays++;
	}
	$totalCost = $totalDays * $roomPrice;

	$sql = "INSERT INTO reservation (roomGrade, checkIn, checkOut, emailAddress, totalCost) VALUES (?, ?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssssd", $roomGrade, $checkIn, $checkOut, $emailAddress, $totalCost);

	if ($stmt->execute()) {
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

	function sendToNodeJs($data)
	{
		$url = 'http://localhost:3000/reservation';
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
			echo "Error sending data to Node.js.";
		} else {
			echo $result;
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
