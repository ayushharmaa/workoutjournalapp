<?php
session_start();
include('../conn/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];

    // Fetch the user's name from the database
    $stmt = $conn->prepare("SELECT `first_name`, `last_name` FROM `tbl_user` WHERE `tbl_user_id` = :user_id");
    $stmt->bindParam(':user_id', $userID);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];

        // Retrieve activities based on the search date
        $searchDate = $_POST['searchDate'];

        // Assuming you have a function to sanitize and validate input
        $searchDate = sanitizeAndValidate($searchDate);

        // Assuming you have a prepared statement to fetch activities for a specific date
        $stmt = $conn->prepare("SELECT * FROM tbl_activities WHERE user_id = :user_id AND date = :searchDate");
        $stmt->bindParam(':user_id', $userID);
        $stmt->bindParam(':searchDate', $searchDate);
        $stmt->execute();

        // Fetch and display the activities
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Display the retrieved data as needed
            echo "Activity: " . $row['activity'] . "<br>";
            // Add more fields as needed
        }
    }
}

// Function to sanitize and validate input (you may need to customize this)
function sanitizeAndValidate($input) {
    // Perform any necessary sanitization and validation
    return htmlspecialchars(trim($input));
}
?>
