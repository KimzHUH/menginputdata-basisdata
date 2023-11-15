<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Cek apakah username terdaftar dalam session
    if (isset($_SESSION['registered_users'][$username])) {
        // Ambil password yang terdaftar
        $storedPassword = $_SESSION['registered_users'][$username]['password'];

        // Periksa apakah password cocok
        if ($password == $storedPassword) {
            $_SESSION["loggedin"] = true;
            header("Location: index.php");
            exit;
        } else {
            $loginError = "Username atau password salah.";
        }
    } else {
        $loginError = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 48%; /* Sejajar dengan formulir */
        }

        .register-button {
            background-color: #2196F3; /* Warna biru */
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            color: red;
            margin-top: 10px;
        }

        #capsLockWarning {
            color: red;
            display: none;
        }
        .input-box input {
            width: calc(100% - 30px);
            padding: 10px;
            box-sizing: border-box;
        }

        .input-box img {
            width: 20px;
            cursor: pointer;
            position: absolute;
            right: 5px;
        }
    </style>
    <script>
        function checkCapsLock(event) {
            var capsLockOn = event.getModifierState && event.getModifierState('CapsLock');
            var message = document.getElementById('capsLockWarning');

            if (capsLockOn) {
                message.style.display = 'block';
            } else {
                message.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <form method="post" action="" onkeydown="checkCapsLock(event)">
        <h2>Login Dulu Bang</h2>
        <label for="username">Username</label>
        <input type="text" name="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
        <a href="register.php" class="register-button"><button type="button">Registrasi</button></a>

        <?php if (isset($loginError)) : ?>
            <p><?php echo $loginError; ?></p>
        <?php endif; ?>

        <p id="capsLockWarning">Caps Lock is ON</p>
    </form>
</body>
</html>
