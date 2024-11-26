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
    <?php
    include "navbar.php";

    if (!isset($_SESSION['loginUser'])) {
        header("Location: login.php");
        exit();
    }

    include 'DBconn.php';

    $emailAddress = $_SESSION['loginUser'];

    $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $memberSql = "SELECT memberID FROM member WHERE emailAddress = ?";
    $memberStmt = $conn->prepare($memberSql);
    $memberStmt->bind_param("s", $emailAddress);
    $memberStmt->execute();
    $memberResult = $memberStmt->get_result();
    
    if ($memberResult->num_rows > 0) {
        $memberData = $memberResult->fetch_assoc();
        $memberID = $memberData['memberID'];
        

        $bookingSql = "SELECT bookingID, roomNumber, reservedStartDate, reservedEndDate 
                      FROM booking 
                      WHERE memberID = ?";
        $bookingStmt = $conn->prepare($bookingSql);
        $bookingStmt->bind_param("i", $memberID);
        $bookingStmt->execute();
        $bookingResult = $bookingStmt->get_result();

        echo '<div class="booking-page">';
        echo '<h1>Booking Information</h1>';
        echo '<div class="booking-info">';
        
        if ($bookingResult->num_rows > 0) {
            $booking = $bookingResult->fetch_assoc();
            echo '<p><strong>Booking ID:</strong> ' . htmlspecialchars($booking['bookingID']) . '</p>';
            echo '<p><strong>Room Number:</strong> ' . htmlspecialchars($booking['roomNumber']) . '</p>';
            echo '<p><strong>Reserved Start Date:</strong> ' . htmlspecialchars($booking['reservedStartDate']) . '</p>';
            echo '<p><strong>Reserved End Date:</strong> ' . htmlspecialchars($booking['reservedEndDate']) . '</p>';
        } else {
            echo '<p>You do not have a booking.</p>';
        }
        
        echo '</div></div>';
        
        $bookingStmt->close();
    }

    $memberStmt->close();
    $conn->close();
    ?>
    <?php include "footer.php"; ?>
</body>
</html>
