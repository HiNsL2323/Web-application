<?php
    // Connect to database
    include 'DBconn.php';

    if (isset($_POST['submit'])) {
        $loginflag = true;

        if (empty($_POST['email'])) {
            $loginemail = null;
            $loginflag = false;
        } else {
            $loginemail = $_POST['email'];
        }

        if (empty($_POST['password'])) {
            $loginpassword = null;
            $loginflag = false;
        } else {
            $loginpassword = $_POST['password'];
        }

        if ($loginflag) {
            // Check user email existence
            $sql = "SELECT * FROM member WHERE emailAddress = '$loginemail'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            // decrypt password 
            if ($row && password_verify($loginpassword, $row['password'])) {
                // If user found and password matches
                session_start();
                $_SESSION['loginUserID'] = $row['memberID'];
                $_SESSION['loginUser'] = $row['emailAddress'];
                header("location: home.php");
            } else {
                // If user not found or password doesn't match
                header("location: loginfailure.php");
            }
        } else {
            echo 'Please fill in all fields.';
        }
    } else {
        echo 'Error: Form not submitted correctly.';
    }
    mysqli_close($conn);
?>
  
