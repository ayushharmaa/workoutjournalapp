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

    <div class="container row">

        <div class="title-container col-7">
            <h1>Workout Journal App</h1>
            <p>
                Welcome to the Workout Journal App – your personalized workout companion on the journey to a healthier you! Our app is designed to empower and support you in achieving your workout goals by providing a user-friendly platform to track your workouts, meals, and overall well-being.
            </p>
        </div>

        <div class="login-register-container col-5">

        <!-- Login Area -->
        <div class="login" id="loginForm">
            <h1 class="text-center">Login Form</h1>
            <div class="login-form">
                <form action="./endpoint/login.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <p class="login-registration-button" onclick="showRegistrationForm()">No Account? Register Here.</p>
                    <button type="submit" class="btn btn-light login-btn form-control">Login</button>
                </form>
            </div>
        </div>


        <!-- Registration Area -->
        <div class="registration" id="registrationForm" style="display:none;">
            <h1 class="text-center">Registration Form</h1>
            <div class="registration-form">
            <form action="./endpoint/add-user.php" method="POST">
                <div class="form-group row">
                    <div class="col-6">
                        <label for="firstName">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="first_name">
                    </div>
                    <div class="col-6">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="last_name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3">
                        <label for="weight">Weight(kg):</label>
                        <input type="number" class="form-control" id="weight" name="weight">
                    </div>
                    <div class="col-3">
                        <label for="height">Height(cm):</label>
                        <input type="number" class="form-control" id="height" name="height">
                    </div>
                    <div class="col-6">
                        <label for="birthday">Birthday:</label>
                        <input type="date" class="form-control" id="birthday" name="birthday">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-5">
                        <label for="contactNumber">Contact Number:</label>
                        <input type="number" class="form-control" id="contactNumber" name="contact_number" maxlength="11">
                    </div>
                    <div class="col-7">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="registerUsername">Username:</label>
                    <input type="text" class="form-control" id="registerUsername" name="username">
                </div>
                <div class="form-group">
                    <label for="registerPassword">Password:</label>
                    <input type="password" class="form-control" id="registerPassword" name="password">
                </div>
                <p class="login-registration-button" onclick="showLoginForm()"><- Back</p>
                <button type="submit" class="btn btn-dark login-register form-control">Register</button>
            </form>

            </div>

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