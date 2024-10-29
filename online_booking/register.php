<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="img/favicon/favicon.ico">
	<link rel="stylesheet" href="css/layout.css">
	<title>Register</title>
</head>
<body>
    <?php include "navbar.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $mailingAddress = $_POST['mailingAddress'];
        $phoneNumber = $_POST['phoneNumber'];
        $memberID = $_POST['memberID'];
        $emailAddress = $_POST['emailAddress'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security


        $conn = mysqli_connect($db_servername, $db_username, $db_password, $db_name);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            echo "";
        }
        
      // Check if email already exists
      $emailCheckSql = "SELECT * FROM member WHERE emailAddress = '$emailAddress'";
      $emailCheckResult = $conn->query($emailCheckSql);

      // Check if member ID already exists
      $memberIDCheckSql = "SELECT * FROM member WHERE memberID = '$memberID'";
      $memberIDCheckResult = $conn->query($memberIDCheckSql);

      if ($emailCheckResult->num_rows > 0) {
          echo "Email address already exists. Please use a different one.";
      } elseif ($memberIDCheckResult->num_rows > 0) {
          echo "Member ID already exists. Please use a different one.";
      } else {
          // Insert new record
          $sql = "INSERT INTO member (lastName, firstName, mailingAddress, phoneNumber, memberID, emailAddress, password)
                  VALUES ('$lastName', '$firstName', '$mailingAddress', '$phoneNumber', '$memberID', '$emailAddress', '$password')";

          if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }
      }
        $conn->close();
    }
    ?>

    <form action="" method="post">
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required><br>

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required><br>

        <label for="mailingAddress">Mailing Address:</label>
        <input type="text" id="mailingAddress" name="mailingAddress" required><br>

        <label for="phoneNumber">Phone Number:</label>
        <input type="text" id="phoneNumber" name="phoneNumber" required><br>

        <label for="memberID">Member ID:</label>
        <input type="text" id="memberID" name="memberID" required><br>

        <label for="emailAddress">Email Address:</label>
        <input type="email" id="emailAddress" name="emailAddress" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
<?php include "footer.php"; ?>