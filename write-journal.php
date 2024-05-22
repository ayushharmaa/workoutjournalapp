<?php
session_start();
include ('./conn/conn.php');

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];

    // Fetch the user's name from the database
    $stmt = $conn->prepare("SELECT `first_name`, `last_name` FROM `tbl_user` WHERE `tbl_user_id` = :user_id");
    $stmt->bindParam(':user_id', $userID);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
    }

    ?>

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

            <div class="form-container">
                <h1 class="text-center mb-3">What did you do today?</h1>
                <form action="./endpoint/add-activity.php" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="date">Date:</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="timeStart">Time Start:</label>
                            <input type="time" class="form-control" id="timeStart" name="timeStart">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="timeEnd">Time End:</label>
                            <input type="time" class="form-control" id="timeEnd" name="timeEnd">
                        </div>
                    </div>

                    <table id="additionalActivities" class="table">
                        <thead>
                            <tr style="color: rgb(255, 255, 255)">
                                <th style="width: 200px;">Activity:</th>
                                <th>Time:</th>
                                <th>Dist:</th>
                                <th>Set:</th>
                                <th>Reps:</th>
                                <th style="width: 220px;">Note:</th>
                                <th>Action:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="additional-activity">
                                <td><input type="text" class="form-control" name="activity[]"></td>
                                <td><input type="text" class="form-control" name="time[]"></td>
                                <td><input type="text" class="form-control" name="distance[]"></td>
                                <td><input type="text" class="form-control" name="set[]"></td>
                                <td><input type="text" class="form-control" name="reps[]"></td>
                                <td><input type="text" class="form-control" name="activityNote[]"></td>
                                <td><button type="button" class="btn btn-danger" onclick="removeInputs()">Remove</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="form-control btn btn-dark float-right mb-3" onclick="addActivity()">Add Activity</button>

                    <button type="submit" class="btn btn-primary float-right">Submit Journal</button>
                </form>

                <a class="btn btn-secondary" href="./home.php">Back to Home Page</a>
            </div>
 
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
        
        <!-- Script JS -->
        <script src="./assets/script.js"></script>
        
        <script>
            function addActivity() {
                // Clone the template for additional activities
                var template = document.querySelector('.additional-activity');
                var clone = template.cloneNode(true);

                // Clear the values in the cloned fields
                var inputs = clone.querySelectorAll('input');
                inputs.forEach(function (input) {
                    input.value = '';
                });

                // Append the cloned fields to the table body
                document.querySelector('#additionalActivities tbody').appendChild(clone);
            }

            function removeInputs() {
                var tableBody = document.querySelector('#additionalActivities tbody');
                var rows = tableBody.querySelectorAll('.additional-activity');

                // Ensure there is at least one row
                if (rows.length > 1) {
                    // Remove the last row
                    tableBody.removeChild(rows[rows.length - 1]);
                }
            }
        </script>

    </body>
    </html>

    <?php

    } else {
        header("Location: http://localhost/workout-journal/index.php");
    }

?>