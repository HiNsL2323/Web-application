<?php

// Predefine filtering result in rooms.php

if (isset($_GET['roomGrade'])) {
    $selectedroomGrade = isset($_GET['roomGrade']) ? $_GET['roomGrade'] : '';
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
	<link rel="stylesheet" href="css/layout.css">
	<title>Reservation</title>
</head>

<body>
	<?php include "navbar.php"; ?>

    <form method="POST" action="roomSearch.php">
        <label for="roomGrade">Room Grade:</label>
        <select name="roomGrade" id="roomGrade">
            <option value="Presidential" <?php echo ($selectedroomGrade == 'Presidential') ? 'selected' : ''; ?> >Presidential</option>
            <option value="Suite" <?php echo ($selectedroomGrade == 'Suite') ? 'selected' : ''; ?> >Suite</option>
            <option value="Executive" <?php echo ($selectedroomGrade == 'Executive') ? 'selected' : ''; ?> >Executive</option>
			<option value="Deluxe" <?php echo ($selectedroomGrade == 'Deluxe') ? 'selected' : ''; ?> >Deluxe</option>
			<option value="Standard" <?php echo ($selectedroomGrade == 'Standard') ? 'selected' : ''; ?> >Standard</option>
        </select><br>

        <label for="reservedStartDate">Check In Date:</label>
        <input type="date" name="reservedStartDate" id="reservedStartDate"><br>

        <label for="reservedEndDate">Check Out Date:</label>
        <input type="date" name="reservedEndDate" id="reservedEndDate"><br>

        <label for="reservedStartTime">Check In Time:</label>
        <input type="time" name="reservedStartTime" id="reservedStartTime"><br>

        <label for="reservedEndTime">Check Out Time:</label>
        <input type="time" name="reservedEndTime" id="reservedEndTime"><br>

        <input type="submit" name="search" value="Search">
    </form>

	<?php include "footer.php"; ?>
</body>

</html>