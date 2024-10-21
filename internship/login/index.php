<?php include ('./conn/conn.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration and Login System</title>

    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="main">

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
                    <p class="registrationForm" onclick="showRegistrationForm()">No Account? Register Here.</p>
                    <button type="submit" class="btn btn-dark login-btn form-control">Login</button>
                </form>
            </div>
        </div>


        <!-- Registration Area -->
        <div class="registration" id="registrationForm">
            <h1 class="text-center">Registration Form</h1>
            <div class="registration-form">
                <form action="./endpoint/add-user.php" method="POST">
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="firstName">First Name:</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" required>
                        </div>
                        <div class="col-6">
                            <label for="lastName">Last Name:</label>
                            <input type="text" class="form-control" id="lastName" name="last_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-5">
                            <label for="contactNumber">Contact Number:</label>
                            <input type="tel" class="form-control" id="contactNumber" name="contact_number"
                                pattern="[0-9]{10}" required>
                        </div>
                        <div class="col-7">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="registerUsername">Username:</label>
                        <input type="text" class="form-control" id="registerUsername" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Address:</label>
                        <input type="text" class="form-control" id="registerAddress" name="address" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="registerPassword">Password:</label>
                            <input type="password" class="form-control" id="registerPassword" name="password" required>
                        </div>
                        <div class="col-6">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                    </div>
                
                    <p class="registrationForm" onclick="showLoginForm()"><- Back</p>
                            <button type="submit" class="btn btn-dark login-register form-control">Register</button>
                </form>

            </div>

        </div>

    </div>

    <script>
        // Constant variables
        const loginForm = document.getElementById('loginForm');
        const registrationForm = document.getElementById('registrationForm');

        // Hide registration form
        registrationForm.style.display = "none";


        function showRegistrationForm() {
            registrationForm.style.display = "";
            loginForm.style.display = "none";
        }

        function showLoginForm() {
            registrationForm.style.display = "none";
            loginForm.style.display = "";
        }

    </script>

    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

</body>

</html>