<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon/favicon.ico">
    <link rel="stylesheet" href="css/layout.css">
    <title>My Member Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .member-page {
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
        .member-info {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .member-info p {
            font-size: 1.1em;
            color: #555;
            margin: 5px 0;
        }
        .member-info p strong {
            color: #333;
        }
        .member-info p:nth-child(odd) {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 4px;
        }
        .member-info p:nth-child(even) {
            background-color: #e9e9e9;
            padding: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <?php
    // Include the navbar which starts the session
    include "navbar.php";

    // Check if user is logged in
    if (!isset($_SESSION['loginUser'])) {
        header("Location: login.php");
        exit();
    }

    // Database connection
    include 'DBconn.php';

    // Get the logged-in user's email address
    $emailAddress = $_SESSION['loginUser'];

    // Fetch member data based on email address using prepared statements
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT lastName, firstName, mailingAddress, phoneNumber, memberID, emailAddress FROM member WHERE emailAddress = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $emailAddress);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $member = $result->fetch_assoc();
    } else {
        echo "No member information found.";
        exit();
    }

    $stmt->close();
    $conn->close();
    ?>

    <div class="member-page">
        <h1>Member Information</h1>
        <div class="member-info">
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($member['lastName']); ?></p>
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($member['firstName']); ?></p>
            <!--<p><strong>Mailing Address:</strong> <?php echo htmlspecialchars($member['mailingAddress']); ?></p>-->
            <p><strong>Mailing Address:</strong> <?php echo "<br><br>" . nl2br($member['mailingAddress']); ?></p>
            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($member['phoneNumber']); ?></p>
            <p><strong>Member ID:</strong> <?php echo htmlspecialchars($member['memberID']); ?></p>
            <p><strong>Email Address:</strong> <?php echo htmlspecialchars($member['emailAddress']); ?></p>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
