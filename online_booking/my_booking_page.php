<?php
include "navbar.php";

if (!isset($_SESSION['loginUser'])) {
    header("Location: login.php");
    exit();
}

include 'DBconn.php';

$emailAddress = $_SESSION['loginUser'];

$sql = "SELECT id, roomGrade, checkIn, checkOut, totalCost 
        FROM reservation 
        WHERE emailAddress = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $emailAddress);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="static/img/favicon/favicon1.ico">
    <link rel="stylesheet" href="static/css/layout.css">
    <title>My Booking Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .booking-page {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
        }
        .booking-info {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .booking-info p {
            font-size: 1.1em;
            color: #555;
            margin: 5px 0;
            padding: 10px;
            border-radius: 4px;
        }
        .booking-info p:nth-child(odd) {
            background-color: #f9f9f9;
        }
        .booking-info p:nth-child(even) {
            background-color: #e9e9e9;
        }
    </style>
</head>
<body>
    <div class="booking-page">
        <h1>Booking Information</h1>
        <div class="booking-info">
            <?php
            if ($result->num_rows > 0) {
                while ($reservation = $result->fetch_assoc()) {
                    echo '<p><strong>Booking ID:</strong> ' . htmlspecialchars($reservation['id']) . '</p>';
                    echo '<p><strong>Room Grade:</strong> ' . htmlspecialchars($reservation['roomGrade']) . '</p>';
                    echo '<p><strong>Check-In:</strong> ' . htmlspecialchars($reservation['checkIn']) . '</p>';
                    echo '<p><strong>Check-Out:</strong> ' . htmlspecialchars($reservation['checkOut']) . '</p>';
                    echo '<p><strong>Total Cost:</strong> $' . htmlspecialchars($reservation['totalCost']) . '</p>';
                    echo '<hr>';
                }
            } else {
                echo '<p>You do not have any bookings.</p>';
            }
            ?>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
