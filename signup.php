<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheFirm - Create Account</title>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/signUp.css">
</head>

<body>
    <!-- Signup Container -->
    <div class="signup-container" id="signupContainer">
        <div class="signup-logo">
            <span><i class="fas fa-balance-scale"></i>TheFirm</span>
        </div>

        <div class="signup-box">
            <div class="signup-header">
                <header>Create Account</header>
                <p>Enter your personal details to get started</p>
            </div>

            <form id="signupForm" action="signupProcess.php" method="post" autocomplete="on">
                <div class="form-row">
                    <div class="form-col">
                        <div class="input-box">
                            <label for="firstname">First Name</label>
                            <input type="text" id="firstname" name="fn" class="input-field" placeholder="Enter your first name" autocomplete="off">
                            <div class="error-message" id="fnError" style="display:none;">
                                <i class="fas fa-exclamation-circle mr-1"></i><span id="fnErrorText"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-col">
                        <div class="input-box">
                            <label for="lastname">Last Name</label>
                            <input type="text" id="lastname" name="ln" class="input-field" placeholder="Enter your last name" autocomplete="off">
                            <div class="error-message" id="lnError" style="display:none;">
                                <i class="fas fa-exclamation-circle mr-1"></i><span id="lnErrorText"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="input-box">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="add" class="input-field" placeholder="Enter your address" autocomplete="off">
                    <div class="error-message" id="addressError" style="display:none;">
                        <i class="fas fa-exclamation-circle mr-1"></i><span id="addressErrorText"></span>
                    </div>
                </div>

                <div class="input-box">
                    <label for="phone">Phone Number</label>
                    <input type="number" id="phone" name="phone" class="input-field" placeholder="Enter your phone number" autocomplete="off">
                    <div class="error-message" id="phoneError" style="display:none;">
                        <i class="fas fa-exclamation-circle mr-1"></i><span id="phoneErrorText"></span>
                    </div>
                </div>

                <div class="input-box">
                    <label for="email">Email Address</label>
                    <input type="text" id="email" name="email" class="input-field" placeholder="Enter your email address" autocomplete="off">
                    <div class="error-message" id="emailError" style="display:none;">
                        <i class="fas fa-exclamation-circle mr-1"></i><span id="emailErrorText"></span>
                    </div>
                </div>

                <div class="input-box">
                    <label for="password">Create Password</label>
                    <input type="password" id="password" name="pass" class="input-field" placeholder="Create a secure password" autocomplete="off">
                    <div class="error-message" id="passError" style="display:none;">
                        <i class="fas fa-exclamation-circle mr-1"></i><span id="passErrorText"></span>
                    </div>
                </div>

                <div class="input-box">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm_pass" class="input-field" placeholder="Re-enter your password" autocomplete="off">
                    <div class="error-message" id="passwordError" style="display:none;">
                        <i class="fas fa-exclamation-circle mr-1"></i>Passwords do not match.
                    </div>
                </div>

                <div class="captcha">   
                    <div class="form-group">
                        <label for="captcha">Are you human? (Enter the text below)</label><br>
                        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                        <div class="g-recaptcha" data-sitekey="6Lco0vwqAAAAAN6H0oUvKJg0-3biDFs1wCQr3Gey"></div>
                    </div>
                </div>

                <div class="input-submit">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-user-plus mr-2"></i>Create Account
                    </button>
                </div>

                <div class="sign-up-link">
                    <p>Already have an account? <a href="login.php">Sign In</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>