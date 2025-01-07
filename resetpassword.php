

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(120deg, #090a0f, #1b1d29);
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #00d4ff;
        }

        .input-field {
            width: 80%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 25px;
            outline: none;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 16px;
            box-shadow: 0 0 8px rgba(0, 255, 255, 0.5);
        }

        .input-field:focus {
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.7);
        }

        .btn-submit {
            width: 50%;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            background: linear-gradient(90deg, #00d4ff, #00ff95);
            color: #000;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            transition: 0.3s;
        }

        .btn-submit:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
        }

        .login-link {
            display: block;
            margin-top: 20px;
            color: #00d4ff;
            cursor: pointer;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reset Your Password</h1>
        <form action="update_password.php" method="POST">
            <input type="password" name="new_password" class="input-field" placeholder="New Password" required>
            <input type="password" name="confirm_password" class="input-field" placeholder="Confirm New Password" required>
            <button type="submit" class="btn-submit">Update Password</button>
        </form>
        <a href="http://localhost/Student_portal/login.php" class="login-link" id="backToLogin">Back to Login</a>
    </div>

    <script>
        const form = document.querySelector("form");
        const backToLoginLink = document.getElementById("backToLogin");

        form.addEventListener("input", function () {
            const newPassword = form.elements["new_password"].value;
            const confirmPassword = form.elements["confirm_password"].value;

            // Enable the "Back to Login" link only when both fields are filled
            if (newPassword && confirmPassword) {
                backToLoginLink.href = "http://localhost/Student_portal/login.php";
            } else {
                backToLoginLink.removeAttribute("href");
            }
        });
    </script>
</body>
</html>
