<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Format email tidak valid!'); window.location.href='Login.php';</script>";
        exit();
    }

    // Ambil domain
    $email_parts = explode('@', $email);
    if (count($email_parts) !== 2) {
        echo "<script>alert('Email tidak valid!'); window.location.href='Login.php';</script>";
        exit();
    }

    $domain = $email_parts[1];

    // Cek password sesuai dengan domain
    if ($password === $domain) {
        $_SESSION['user_email'] = $email;
        echo "<script>alert('Login berhasil!'); window.location.href='Form.php';</script>";
    } else {
        echo "<script>alert('Login gagal! Periksa email dan password Anda.'); window.location.href='Login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Body Styling */
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        /* Container Styling */
        .container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Welcome Message */
        .welcome-message {
            text-align: center;
            margin-bottom: 20px;
        }

        .welcome-message h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .welcome-message p {
            font-size: 0.9rem;
            color: #666;
        }

        /* Form Elements */
        .input-group {
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .input-field:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Button Styling */
        .btn-login {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        /* Footer Text */
        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome-message">
            <h2>Welcome Back</h2>
            <p>Please login to continue</p>
        </div>
        
        <form action="Login.php" method="POST">
            <div class="input-group">
                <input type="email" name="email" class="input-field" placeholder="Email Address" required>
            </div>
            
            <div class="input-group">
                <input type="password" name="password" class="input-field" placeholder="Password" required>
            </div>
            
            <button type="submit" class="btn-login">Sign In</button>
            
            <p class="footer-text">*Password is your email domain</p>
        </form>
    </div>
</body>
</html>