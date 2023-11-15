<?php
session_start();

$jumlahPengguna = 1000;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST["newUsername"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    // Validasi konfirmasi password
    if ($newPassword !== $confirmPassword) {
        $registrationError = "Konfirmasi password tidak sesuai.";
    } else {
        // Simpan informasi pengguna baru ke dalam session
        if (!isset($_SESSION['registered_users'])) {
            $_SESSION['registered_users'] = [];
        }

        if (array_key_exists($newUsername, $_SESSION['registered_users'])) {
            $registrationError = "Username sudah terdaftar.";
        } else {
            // Simpan informasi pengguna baru sebagai array
            $_SESSION['registered_users'][$newUsername] = [
                'password' => $newPassword
            ];
            $registrationSuccess = "Pendaftaran berhasil! Silakan login.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membuat Akun</title>
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

        h2 {
            margin-bottom: 20px;
            color: #333; /* Ubah warna teks sesuai kebutuhan */
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .input-box {
            display: flex;
            align-items: center;
            position: relative;
            margin-bottom: 20px;
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

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px; /* Tambahkan jarak antara tombol dan pesan error/success */
        }

        button.register-button {
            background-color: #2196F3; /* Warna biru */
        }

        button:hover {
            background-color: #45a049;
        }

        p.error {
            color: red;
            margin-bottom: 10px;
        }

        p.success {
            color: green;
            margin-bottom: 10px;
        }

        a {
            color: #2196F3; /* Warna biru */
        }

        #capsLockWarning {
            color: red;
            display: none;
        }

        .login-link {
            margin-top: 10px;
            font-size: 14px;
            color: #333; /* Ubah warna teks sesuai kebutuhan */
        }
        label {
            display: inline-block;
            width: 120px; 
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

        function togglePasswordVisibility(inputId, toggleId) {
            var passwordInput = document.getElementById(inputId);
            var passwordToggle = document.getElementById(toggleId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.src = 'eye-open.jpg';
            } else {
                passwordInput.type = 'password';
                passwordToggle.src = 'eye-close.jpg';
            }
        }
    </script>
</head>
<body>
    <form method="post" action="" onkeydown="checkCapsLock(event)">
        <h2>Membuat Akun</h2>
        <div class="input-box">
        <label for="newUsername">Username:</label>
        <input type="text" name="newUsername" required>
        </div>

        <div class="input-box">
            <label for="newPassword">Password:</label>
            <input type="password" name="newPassword" id="newPassword" required>
            <img src="eye-close.jpg" onclick="togglePasswordVisibility('newPassword', 'passwordToggle')">
        </div>
        
        <div class="input-box">
            <label for="confirmPassword">Konfirmasi Password:</label>
            <input type="password" name="confirmPassword" id="confirmPassword" required>
            <img src="eye-close.jpg" onclick="togglePasswordVisibility('confirmPassword', 'confirmPasswordToggle')">
        </div><br><br>

        <?php if (isset($registrationError)) : ?>
            <p class="error"><?php echo $registrationError; ?></p>
        <?php endif; ?>

        <?php if (isset($registrationSuccess)) : ?>
            <p class="success"><?php echo $registrationSuccess; ?></p>
        <?php endif; ?>

        <button type="submit" class="register-button">Daftar</button>

        <p class="login-link">Sudah punya akun? <a href="login.php">Login disini</a></p>
        <p id="capsLockWarning">Caps Lock is ON</p>
    </form>
</body>
</html>
