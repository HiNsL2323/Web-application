<?php
	// Database parameter
	$db_servername = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'online_booking';
	
	// Connect to MySQL
	$conn = mysqli_connect($db_servername, $db_username, $db_password, $db_name);
	
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	} else {
		echo "
			<script>
				console.log('Connection Success!');
			</script>
		";
	}
?>