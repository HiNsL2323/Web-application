<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon/favicon.ico">
    <link rel="stylesheet" href="css/layout.css">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .register-page {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 15px 0 5px;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
        .error {
            color: red;
            margin-top: -15px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="register-page">
        <h2>Register</h2>
        <?php
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
            <input type="text" id="lastName" name="lastName" required>

            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="mailingAddress">Mailing Address:</label>
            <input type="text" id="mailingAddress" name="mailingAddress" required>

            <label for="phoneNumber">Phone Number:</label>
            <input type="text" id="phoneNumber" name="phoneNumber" required>

            <label for="memberID">Member ID:</label>
            <input type="text" id="memberID" name="memberID" required>

            <label for="emailAddress">Email Address:</label>
            <input type="email" id="emailAddress" name="emailAddress" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Register">
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
