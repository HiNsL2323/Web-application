<?php
include "navbar.php";
include "DBconn.php";

// Only process form if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commentID = uniqid();
    $created = date('Y-m-d H:i:s');
    $commentText = $_POST['commentText'];

    if (isset($_SESSION['loginUser'])) {
        // Get member details from member table using the logged-in user's session
        $memberQuery = "SELECT memberID, firstName, lastName, emailAddress FROM member WHERE emailAddress = ?";
        $memberStmt = $conn->prepare($memberQuery);
        $memberStmt->bind_param("s", $_SESSION['loginUser']);
        $memberStmt->execute();
        $result = $memberStmt->get_result();
        $memberData = $result->fetch_assoc();
        
        // Insert comment with member data
        $sql = "INSERT INTO comment (commentID, memberID, guestFirstName, guestLastName, guestEmail, commentText, created) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisssss", $commentID, $memberData['memberID'], $memberData['firstName'], 
                         $memberData['lastName'], $memberData['emailAddress'], $commentText, $created);
        $memberStmt->close();
    } else {
        // Handle guest comment
        $sql = "INSERT INTO comment (commentID, guestEmail, guestFirstName, guestLastName, commentText, created) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $commentID, $_POST['email'], $_POST['firstName'], 
                         $_POST['lastName'], $commentText, $created);
    }

    if($stmt->execute()) {
        $successMessage = "Thanks for your comment!";
    } else {
        $errorMessage = "Error adding comment.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="static/img/favicon/favicon.ico">
    <link rel="stylesheet" href="static/css/layout.css">
    <title>Contact Us</title>
    <style>
        * {
            box-sizing: border-box;
        }
        input[type=text],
        input[type=email],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }
        input[type=submit],
        button[type=submit] {
            background-color: #222;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            max-height : auto;
        }
        input[type=submit]:hover,
        button[type=submit]:hover {
            background-color: #757575;
        }
        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 10px;
            max-width: auto;
            max-height: auto;
            margin: 20px auto;
        }
        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }
        .error-message {
            background-color: #f2dede;
            color: #a94442;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }
        .row {
    display: flex;
    flex-direction: row;
    margin: 0 -16px;
}

.column {
    flex: 50%;
    padding: 0 16px;
}

.column img {
    margin-top: 25px;
    border-radius: 5px;
    size: auto
}

@media screen and (max-width: 600px) {
    .row {
        flex-direction: column;
    }
    .column {
        flex: 100%;
        padding: 0;
    }
}
    </style>
</head>

<body>
<div class="main">
        <div class="container">
            <div class="row">
                <div class="column">
                    <img src="static/img/widget/frontdesk.jpg" style="width:100%">
                </div>
                <div class="column">
                    <?php if(isset($successMessage)): ?>
                        <div class="success-message"><?php echo $successMessage; ?></div>
                    <?php endif; ?>
                    
                    <?php if(isset($errorMessage)): ?>
                        <div class="error-message"><?php echo $errorMessage; ?></div>
                    <?php endif; ?>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <?php if(!isset($_SESSION['loginUser'])): ?>
                            <label for="firstname">First Name</label>
                            <input type="text" id="firstname" name="firstName" placeholder="Your name.." required>

                            <label for="lastname">Last Name</label>
                            <input type="text" id="lastname" name="lastName" placeholder="Your last name.." required>

                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Your email" required>
                        <?php endif; ?>

                        <label for="comment">Comment</label>
                        <textarea id="comment" name="commentText" placeholder="Please leave a comment for us." style="height:170px" required></textarea>

                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
</body>
</html>
