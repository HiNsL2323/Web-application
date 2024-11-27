<?php

include 'DBconn.php';

if (isset($_GET['roomGrade'])) {
	$selectedroomGrade = isset($_GET['roomGrade']) ? $_GET['roomGrade'] : '';
	$roomGrade = mysqli_real_escape_string($conn, $_GET['roomGrade']);
	$sql = "SELECT * FROM room_details WHERE roomGrade = '$roomGrade'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
} else {
	$selectedroomGrade = null;
}



?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="img/favicon/favicon.ico">
	<link rel="stylesheet" href="static/css/reservation.css">
	<title>Reservation</title>
</head>

<body>
	<?php include "navbar.php"; ?>
	<?php
	if (!isset($_SESSION['loginUser'])) {
		echo "
    		<div class='warning-message'>
    		    <p style='font-size: 20px; color: #333;'>Please log in to make a reservation.</p><br/>
						<button onclick=\"location.href='login.php';\">Login</button>
    		</div>";
		include "footer.php";
		return;
	} ?>

	<section id="room-page">
		<div class="room-content">
			<div class="left-section">
				<div class="room-details">
					<div class="room-img">
						<?php echo "<img src='static/img/rooms/{$row['roomIMG']}' />"; ?>
					</div>
				</div>

				<div class="room-text">
					<div class="room-text-left">
						<span class="room-category">Grade</span>
						<h3><?php echo $row['roomGrade']; ?></h3>
						<p><?php echo nl2br($row['roomSpec']); ?></p>
					</div>
					<div class="room-text-right">
						<span class="room-price">HK$ <?php echo $row['roomPrice']; ?></span>
					</div>
				</div>
			</div>


			<div class="right-section">
				<div class="room-form">
					<h3>Reserve Your Room</h3>
					<form method="POST" action="roomSearch.php" onsubmit="return validateDateRange()">
						<label for="roomGrade">Room Grade:</label>
						<select name="roomGrade" id="roomGrade" onchange="updateRoomGrade()">
							<option value="Presidential" <?php echo ($selectedroomGrade == 'Presidential') ? 'selected' : ''; ?>>
								Presidential</option>
							<option value="Suite" <?php echo ($selectedroomGrade == 'Suite') ? 'selected' : ''; ?>>Suite</option>
							<option value="Executive" <?php echo ($selectedroomGrade == 'Executive') ? 'selected' : ''; ?>>Executive
							</option>
							<option value="Deluxe" <?php echo ($selectedroomGrade == 'Deluxe') ? 'selected' : ''; ?>>Deluxe</option>
							<option value="Standard" <?php echo ($selectedroomGrade == 'Standard') ? 'selected' : ''; ?>>Standard
							</option>
						</select><br>

						<label for="reservedStartDate">Check In Date:</label>
						<input type="date" name="reservedStartDate" id="reservedStartDate"><br>

						<label for="reservedEndDate">Check Out Date:</label>
						<input type="date" name="reservedEndDate" id="reservedEndDate"><br>

						<label for="reservedStartTime">Check In Time:</label>
						<input type="time" name="reservedStartTime" id="reservedStartTime"><br>

						<label for="reservedEndTime">Check Out Time:</label>
						<input type="time" name="reservedEndTime" id="reservedEndTime"><br>

						<input type="hidden" name="emailAddress" value="<?php echo $_SESSION['loginUser']; ?>">

						<input type="submit" name="Reserve" value="Reserve" class="form-btn">

						<div class="button-wrapper">
							<button type="reset" class="clear-btn">Clear</button>
							<a href="home.php" class="form-btn cancel-btn">Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<?php include "footer.php"; ?>
</body>
<script>
	function updateRoomGrade() {
		const roomGrade = $('#roomGrade').val();
		const currentUrl = window.location.href;
		const url = new URL(currentUrl);
		url.searchParams.set('roomGrade', roomGrade);
		window.location.href = url.toString();
	}

	function validateDateRange() {
		const startDate = $('#reservedStartDate').val()
		const endDate = $('#reservedEndDate').val()

		const startTime = $('#reservedStartTime').val()
		const endTime = $('#reservedEndTime').val()

		if (!startDate || !endDate) {
			alert("Please select both Check In and Check Out dates.");
			return false;
		}

		if (!startTime || !endTime) {
			alert("Please select both Check In and Check Out time.");
			return false;
		}

		if (startDate > endDate) {
			alert("Check Out Date must be after or the same as Check In Date.");
			return false;
		}

		return true;
	}
</script>
<script src="static/js/jquery-3.7.1.min.js"></script>

</html>