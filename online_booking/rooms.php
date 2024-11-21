<?php

// Get room grade from URL
if (isset($_GET['roomGrade'])) {

	// Connect to database
	include 'DBconn.php';
	$roomGrade = mysqli_real_escape_string($conn, $_GET['roomGrade']);

	// Get room details from database
	$sql = "SELECT * FROM room_details WHERE roomGrade = '$roomGrade'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

} else {
	echo "
			<script>
				window.location.href='home.php';
			</script>
		";
}

// Close database connection
mysqli_close($conn);

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="static/img/favicon/favicon.ico">
	<link rel="stylesheet" href="static/css/roomDetail.css">
	<title>Rooms</title>
</head>

<body>
	<?php include "navbar.php"; ?>

    <!-- Rooms Details -->
	<section id="room-page">
		<div class="room-details">
			<!-- IMG -->
			<div class="room-img">

				<!-- Swiper Slider -->
				<div class="swiper mySwiper">
					<div class="swiper-slide">
						<?php
						    echo "<img src='static/img/rooms/{$row['roomIMG']}' />";
						?>
					</div>
				</div>

			</div>
			<!-- Text -->
			<div class="room-text">
				<!-- Room Grade-->
				<?php
				    echo "
			            <span class=\"room-category\">Grade</span>
			            <h3>{$row['roomGrade']}</h3>
                        <span class=\"room-price\">{$row['roomPrice']}</span>
                    ";
                    $spec = $row['roomSpec'];
                    echo "<p>".nl2br($spec)."</p>";
				?>

				<!--btn-->
				<div class="room-button">
                    <a href="reservation.php?roomGrade=<?php echo $row['roomGrade'] ?>" class="add-room-btn">Check Available Room</a>
				</div>
			</div>
		</div>
	</section>

    <?php include "footer.php"; ?>
</body>
</html>