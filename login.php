<?php
session_start();
$error = "";
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Clear the error after retrieving it
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futuristic Login Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(120deg, #090a0f, #1b1d29);
            height: 100vh;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .container {
            width: 400px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .container:before {
            content: '';
            position: absolute;
            top: 0;
            left: -50%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(0, 255, 255, 0.3), transparent);
            transform: rotate(45deg);
            animation: glowAnimation 6s linear infinite;
            z-index: -1;
        }

        @keyframes glowAnimation {
            0% {
                left: -50%;
            }
            100% {
                left: 150%;
            }
        }

        h2 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        input {
            width: 80%;
            padding: 12px 15px;
            margin: 10px 0;
            border: none;
            border-radius: 25px;
            outline: none;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 16px;
            box-shadow: 0 0 8px rgba(0, 255, 255, 0.5);
        }

        input:focus {
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.7);
        }

        button {
            width: 50%;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            background: linear-gradient(90deg, #00d4ff, #00ff95);
            color: #000;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
            transition: 0.3s;
        }

        button:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
        }

        .signup-button {
            width: 50%; /* Matches the width of the login button */
            background: linear-gradient(90deg, #ff95d4, #ff00d4);
        }

        .forgot {
            margin-top: 20px;
            color: #00d4ff;
            cursor: pointer;
            text-decoration: none;
            display: block;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        /* Notification Bar */
        .notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(255, 0, 0, 0.9);
            color: #fff;
            padding: 15px 25px;
            border-radius: 5px;
            box-shadow: 0 0 15px rgba(255, 0, 0, 0.5);
            font-size: 16px;
            text-align: center;
            z-index: 9999;
            display: none; /* Initially hidden */
        }

        .notification.show {
            display: block; /* Show when JavaScript adds the class */
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const notification = document.querySelector(".notification");
            if (notification && notification.textContent.trim() !== "") {
                notification.classList.add("show");
                setTimeout(() => {
                    notification.classList.remove("show");
                }, 5000); // Hide after 5 seconds
            }
        });
    </script>
</head>
<body>
    <?php if ($error): ?>
        <div class="notification"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="container">
        <h2>Grading Portal</h2>
        <form action="login_check.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <button type="button" class="signup-button" onclick="location.href='http://localhost/Student_portal/signup.php'">Sign Up</button>
        <a href="http://localhost/Student_portal/forgotpassword.php" class="forgot">Forgot Password?</a>
    </div>
</body>
</html>
