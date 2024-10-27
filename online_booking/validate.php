<?php
    // Connect to database
    include 'DBconn.php';

    if (isset($_POST['submit'])) {
        if (empty($_POST['email'])) {
            $loginemail = null;
            $loginflag = false;
        } else {
            $loginemail = $_POST['email'];
            $loginflag = true;
        }

        if (empty($_POST['password'])) {
            $loginpassword = null;
            $loginflag = false;
        } else {
            $loginpassword = $_POST['password'];
            $loginflag = true;
        }
        
        //Get inputted email and password in form
        $loginemail = $_POST['email'];
        $loginpassword = $_POST['password'];

        // Check user email existence
        $sql = "SELECT * FROM member WHERE emailAddress = '$loginemail' AND password = '$loginpassword'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if (!empty($user['memberID'])) {
            //if user found
            session_start();
            $_SESSION['loginUserID'] = $row['memberID'];
            $_SESSION['loginUser'] = $row['emailAddress'];
            header("location: home.php");

        } else {
            //if user not found
            header("location: loginfailure.php");
        }

    } else {
        echo 'error';
    }

    // Close database connection
    mysqli_close($conn);
?>