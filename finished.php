
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Case Closed – TheFirm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: url('img/closed1.png') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            position: relative;
        }

        /* Add an overlay to ensure text remains readable */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .container {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 90%;
            animation: slideUp 0.8s ease-out;
        }

        .logo-container {
            margin-bottom: 2rem;
        }

        .scales-icon {
            font-size: 4rem;
            color: #fff;
            margin-bottom: 1rem;
            animation: scaleIn 1s ease-out;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #fff;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
        }

        .divider {
            width: 60px;
            height: 4px;
            background: #fff;
            margin: 2rem auto;
            border-radius: 2px;
        }

        .btn {
            display: inline-block;
            padding: 1rem 2rem;
            margin-top: 2rem;
            background: #fff;
            color: #2a5298;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            background: #f8f9fa;
        }

        .firm-logo {
            margin-top: 2rem;
            font-weight: 500;
            font-size: 1.1rem;
            letter-spacing: 2px;
            color: rgba(255, 255, 255, 0.8);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 2rem;
            }
            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <i class="fas fa-balance-scale scales-icon"></i>
        </div>
        <h1>Case Closed</h1>
        <p>This case has been successfully closed and archived.</p>
        <p>Thank you for using TheFirm Case Management System.</p>
        <div class="divider"></div>
        <a href="index.php" class="btn">Return to Dashboard</a>
        <div class="firm-logo">THE FIRM</div>
    </div>
</body>
</html>