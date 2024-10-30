<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Weekly Time Slot Selector</title>
	<link rel="stylesheet" href="static/css/styles.css">
</head>

<body>
	<div id="app">
		<h2>View Week Availability</h2>
		<input type="date" id="date-picker" />

		<div class="time-slot-header weekdays">
			<div class="weekdays">
				<!-- Days of the week headers will populate here dynamically -->
			</div>
		</div>

		<div class="time-slot-grid" id="time-slot-grid">
			<!-- Time slots will populate here dynamically -->
		</div>
	</div>

	<script src="static/js/script.js"></script>
</body>

</html>