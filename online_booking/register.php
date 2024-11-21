<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="static/img/favicon/favicon.ico">
    <link rel="stylesheet" href="static/css/layout.css">
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
        .success {
            color: green;
            margin-top: -15px;
            margin-bottom: 15px;
        }
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="register-page">
        <h2>Register</h2>
        <?php
        $errorMessage = "";
        $successMessage = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $lastName = $_POST['lastName'];
            $firstName = $_POST['firstName'];
            $mailingAddress = $_POST['mailingAddress'];
            $phoneNumber = $_POST['phoneNumber'];
            $emailAddress = $_POST['emailAddress'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security

            $conn = mysqli_connect($db_servername, $db_username, $db_password, $db_name);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if email already exists
            $emailCheckSql = "SELECT * FROM member WHERE emailAddress = '$emailAddress'";
            $emailCheckResult = $conn->query($emailCheckSql);
            
            if ($emailCheckResult->num_rows > 0) {
                $errorMessage = "Email address already exists. Please use a different one.";
            } else {
                // Insert new record
                $sql = "INSERT INTO member (lastName, firstName, mailingAddress, phoneNumber, emailAddress, password)
                        VALUES ('$lastName', '$firstName', '$mailingAddress', '$phoneNumber', '$emailAddress', '$password')";

                if ($conn->query($sql) === TRUE) {
                    $successMessage = "New record created successfully";
                } else {
                    $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
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
            <textarea id="mailingAddress" name="mailingAddress" rows="4" style="width: 100%;" required></textarea>
            <!--<input type="text" id="mailingAddress" name="mailingAddress" required>-->

            <label for="phoneNumber">Phone Number:</label>
            <input type="text" id="phoneNumber" name="phoneNumber" placeholder="12345678" maxlength="8" pattern="\d{8}" required>

            <label for="emailAddress">Email Address:</label>
            <input type="email" id="emailAddress" name="emailAddress" placeholder="testing@domain.com" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Register">
        </form>
    </div>

    <!-- Modal for error messages -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <p id="errorMessage" class="error"></p>
        </div>
    </div>

    <!-- Modal for success messages -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <p id="successMessage" class="success"></p>
        </div>
    </div>

    <?php include "footer.php"; ?>

    <script>
        // Get the modals
        var errorModal = document.getElementById("errorModal");
        var successModal = document.getElementById("successModal");
        var errorMessage = "<?php echo $errorMessage; ?>";
        var successMessage = "<?php echo $successMessage; ?>";

        // Get the <span> elements that close the modals
        var closeButtons = document.getElementsByClassName("close");

        // When the user clicks on <span> (x), close the modal
        for (var i = 0; i < closeButtons.length; i++) {
            closeButtons[i].onclick = function() {
                errorModal.style.display = "none";
                successModal.style.display = "none";
            }
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == errorModal) {
                errorModal.style.display = "none";
            }
            if (event.target == successModal) {
                successModal.style.display = "none";
            }
        }

        // Show the appropriate modal if there's a message
        if (errorMessage) {
            document.getElementById("errorMessage").innerText = errorMessage;
            errorModal.style.display = "block";
        }
        if (successMessage) {
            document.getElementById("successMessage").innerText = successMessage;
            successModal.style.display = "block";
            // Redirect to login page after 3 seconds
            setTimeout(function() {
                window.location.href = 'login.php';
            }, 1000);
        }
    </script>
</body>
</html>
