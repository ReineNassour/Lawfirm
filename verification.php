<!DOCTYPE html>
<?php
session_start();
include 'header.php' ?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Email Verification</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Email Verification" name="keywords">
    <meta content="Verify your email address to complete registration" name="description">

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">

    <link href="css/verification.css" rel="stylesheet">


</head>

<body>


    <section class="verification-section">
        <div class="container mt-5">
            <div class="verification-container">
                <div class="verification-icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>

                <h2 class="verification-title">Email Verification</h2>

                <p class="text-center mb-4">
                    We've sent a verification code to your email address.
                    Please enter the code below to complete your registration.
                </p>

                <div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="verification_code"
                            maxlength="6" placeholder="-- -- --" autocomplete="off" required>
                    </div>

                    <!-- Add status message displays -->
                    <div id="verificationError" class="alert alert-danger" style="display: none;"></div>
                    <div id="codeSentStatus" class="alert code-status"></div>

                    <div class="d-grid gap-2">
                        <button id="verifyCodeBtn" class="btn btn-primary btn-verify">Verify Email</button>
                    </div>

                    <a id="sendCodeBtn" class="resend-link">Didn't receive the code? Resend</a>
                </div>
            </div>
        </div>
    </section>

    <?php include "footer.php" ?>

    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Sticky Header
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.header').addClass('sticky');
            } else {
                $('.header').removeClass('sticky');
            }
        });

        // Back to Top Button
        $(window).scroll(function() {
            if ($(this).scrollTop() > 200) {
                $('.back-to-top').addClass('active');
            } else {
                $('.back-to-top').removeClass('active');
            }
        });

        $('.back-to-top').click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
            return false;
        });

        // Get UI elements
        const errorMsg = document.getElementById('verificationError');
        const statusMsg = document.getElementById('codeSentStatus');
        const verifyBtn = document.getElementById('verifyCodeBtn');
        const resendBtn = document.getElementById('sendCodeBtn');

        $(document).ready(function() {
            $('#verification_code').focus();

            // Optional: Code input auto-formatting
            $('#verification_code').on('input', function() {
                // Replace any non-number characters
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });

            // Add click handlers
            verifyBtn.addEventListener('click', verifyCode);
            resendBtn.addEventListener('click', sendCode);

            // Send code automatically on page load
            sendCode();
        });

        function verifyCode() {
            // Get code value
            let verificationInput = document.getElementById("verification_code").value;

            // Clear previous errors
            errorMsg.style.display = 'none';

            // Disable button and show loading state
            verifyBtn.disabled = true;
            verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Verifying...';

            // Simplified AJAX call
            $.post('verifyCode.php', {
                    'code': verificationInput
                })
                .done(function(response) {
                    try {
                        let result = JSON.parse(response.trim());

                        if (result.success) {
                            showStatus('success', '<i class="fas fa-check-circle me-2"></i>Email verified successfully! Redirecting...');
                            setTimeout(function() {
                                window.location.href = 'index.php';
                            }, 1500);
                        } else {
                            // Show error message
                            errorMsg.textContent = result.error;
                            errorMsg.style.display = 'block';
                            resetButton(verifyBtn, 'Verify Email');
                        }
                    } catch (e) {
                        handleError('Error processing response. Please try again.', e, response);
                    }
                })
                .fail(function(xhr, status, error) {
                    handleError('Error connecting to server. Please try again.', xhr, status, error);
                });
        }

        function sendCode() {
            // Clear previous status
            statusMsg.style.display = 'none';

            // Disable button and show loading state
            if (resendBtn) {
                resendBtn.disabled = true;
                resendBtn.innerHTML = 'Sending...';
            }

            // Simplified AJAX call
            $.post('sendVerificationCode.php')
                .done(function(response) {
                    try {
                        let result = JSON.parse(response.trim());
                        if (result.success) {
                            showStatus('success', '<i class="fas fa-check-circle me-2"></i>Verification code sent! Please check your inbox (and spam folder).');
                            $('#verification_code').focus();
                        } else {
                            showStatus('danger', '<i class="fas fa-exclamation-circle me-2"></i>' + result.error);
                        }
                    } catch (e) {
                        showStatus('danger', '<i class="fas fa-exclamation-circle me-2"></i>Failed To Send Code! Error: Invalid response from server');
                        console.error("JSON Parse error:", e, "Response:", response);
                    }

                    resetButton(resendBtn, 'Resend Code');
                })
                .fail(function(xhr, status, error) {
                    showStatus('danger', '<i class="fas fa-exclamation-circle me-2"></i>Error connecting to server. Please try again.');
                    console.error("AJAX error:", xhr, status, error);
                    resetButton(resendBtn, 'Resend Code');
                });
        }

        // Helper functions
        function showStatus(type, message) {
            statusMsg.className = 'alert alert-' + type + ' code-status';
            statusMsg.innerHTML = message;
            statusMsg.style.display = 'block';
        }

        function resetButton(button, text) {
            if (button) {
                button.disabled = false;
                button.innerHTML = text;
            }
        }

        function handleError(message, ...args) {
            errorMsg.textContent = message;
            errorMsg.style.display = 'block';
            console.error(...args);
            resetButton(verifyBtn, 'Verify Email');
        }
    </script>
</body>

</html>