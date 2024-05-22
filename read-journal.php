<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout Journal App</title>

    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

</head>
<body>

    <div class="main">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand ml-3" href="#">Workout Journal App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./endpoint/logout.php">Log Out</a>
                </li>
            </div>
                
        </nav>

        <div class="journal-container">

            <div class="search-journal">
                <form method="POST">
                    <div class="form-group">
                        <h2 class="mb-4">Search Date:</h2>
                        <input type="date" class="form-control" id="searchDate" name="searchDate">
                    </div>
                    <button type="submit" class="form-control btn btn-primary" name="search">Search</button>
                </form>

                <?php

                // Function to sanitize and validate input (you may need to customize this)
                function sanitizeAndValidate($input) {
                    // Perform any necessary sanitization and validation
                    return htmlspecialchars(trim($input));
                }

                session_start();
                include('./conn/conn.php');

                // Check if the form was submitted and search button clicked
                if (isset($_POST['search'])) {
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

                        echo "<div class='search-results'>";
                        echo "<h2>Search Results:</h2>";


                        
                        // Check if there are results
                        if ($stmt->rowCount() > 0) {
                            // Fetch and display the activities in a table
                            echo "<div class='row mt-2'>";
                            echo "<div class='col-md-12'>";
                            echo "<h4>Date: </h4>";
                            echo $searchDate;
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<table class='table mt-4'>";
                            echo "<thead>";
                            echo "<tr style='color: rgb(255, 255, 255)'>";
                            echo "<th style='width: 200px;'>Activity:</th>";
                            echo "<th>Time:</th>";
                            echo "<th>Dist:</th>";
                            echo "<th>Set:</th>";
                            echo "<th>Reps:</th>";
                            echo "<th style='width: 250px;'>Note:</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                
                                // Display the retrieved data in table rows
                                echo "<tr>";
                                echo "<td>" . $row['activity'] . "</td>";
                                echo "<td>" . $row['time_spent'] . "</td>";
                                echo "<td>" . $row['distance'] . "</td>";
                                echo "<td>" . $row['set_count'] . "</td>";
                                echo "<td>" . $row['reps'] . "</td>";
                                echo "<td>" . $row['note'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</tbody>";
                            echo "</table>";
                            echo "</div>";
                        } else {
                            echo "<p>No activities found for the specified date.</p>";
                            echo "</div>";
                        }
                    }
                }

                ?>

            <a class="btn btn-secondary" href="./home.php">Back to Home Page</a>

            </div>

            <div class="journal">
                <!-- Your journal content goes here -->
            </div>
            
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    
    <!-- Script JS -->
    <script src="./assets/script.js"></script>
</body>
</html>
