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

        // Process form data and add activities to the database
        $date = $_POST['date'];
        $timeStart = $_POST['timeStart'];
        $timeEnd = $_POST['timeEnd'];

        // Assuming you have a function to sanitize and validate input
        $date = sanitizeAndValidate($date);
        $timeStart = sanitizeAndValidate($timeStart);
        $timeEnd = sanitizeAndValidate($timeEnd);

        // Loop through the additional activities and insert into the database
        foreach ($_POST['activity'] as $key => $activity) {
            $activity = sanitizeAndValidate($activity);
            $timeSpent = sanitizeAndValidate($_POST['time'][$key]);
            $distance = sanitizeAndValidate($_POST['distance'][$key]);
            $setCount = intval($_POST['set'][$key]); 
            $reps = intval($_POST['reps'][$key]);
            $activityNote = sanitizeAndValidate($_POST['activityNote'][$key]);

            // Assuming you have a prepared statement to insert data into the database
            $stmt = $conn->prepare("INSERT INTO tbl_activities (user_id, date, time_start, time_end, activity, time_spent, distance, set_count, reps, note) VALUES (:user_id, :date, :time_start, :time_end, :activity, :time_spent, :distance, :set_count, :reps, :note)");
            $stmt->bindParam(':user_id', $userID);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time_start', $timeStart);
            $stmt->bindParam(':time_end', $timeEnd);
            $stmt->bindParam(':activity', $activity);
            $stmt->bindParam(':time_spent', $timeSpent);
            $stmt->bindParam(':distance', $distance);
            $stmt->bindParam(':set_count', $setCount);
            $stmt->bindParam(':reps', $reps);
            $stmt->bindParam(':note', $activityNote);

            $stmt->execute();
        }

        echo "
            <script>
                alert('Activity Added Successfully!');
                window.location.href = 'http://localhost/workout-journal/home.php/';
            </script>
        ";
        exit();
    }
}

// Redirect to the login page if the user is not logged in
header("Location: http://localhost/workout-journal/index.php");
exit();

// Function to sanitize and validate input (you may need to customize this)
function sanitizeAndValidate($input) {
    // Perform any necessary sanitization and validation
    return htmlspecialchars(trim($input));
}
?>
