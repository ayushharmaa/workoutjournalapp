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

        <style>
            body {
                overflow: hidden;
            }
        </style>
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

            <div class="landing-page-container">
                <div class="heading-container">
                    <h2>Welcome <?= $firstName ?> <?= $lastName?></h2>
                    <p>What would you like to do today?</p>
                </div>

                <div class="select-option">
                    <div class="read-journal" onclick="redirectToReadJournal()">
                        <img src="./assets/read.jpg" alt="">
                        <p>Read your past workout journals.</p>
                    </div>
                    <div class="write-journal" onclick="redirectToWriteJournal()">
                        <img src="./assets/write.jpg" alt="">
                        <p>Write your todays journal.</p>
                    </div>
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

    <?php

    } else {
        header("Location: http://localhost/workout-journal/index.php");
    }

?>