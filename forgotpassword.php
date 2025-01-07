

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form action="http://localhost/Student_portal/resetpassword.php" method="POST">
            <input type="email" placeholder="Enter your email" required>
            <button type="submit">Reset Password</button>
        </form>
        <a href="http://localhost/Student_portal/login.php" class="forgot">Back to Login</a>
    </div>
</body>
</html>
