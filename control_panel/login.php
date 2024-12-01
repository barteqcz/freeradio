<?php
    session_start();
    
    require '../php_scripts/db.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userUsername = $_POST['username'];
        $userPassword = $_POST['password'];
    
        $password = $connection->prepare("SELECT password FROM admin_login WHERE admin_login.username = ?");
        $password->bind_param("s", $userUsername);
        $password->execute();
        $password->store_result();
        
        if ($password->num_rows > 0) {
            $password->bind_result($hashedPassword);
            $password->fetch();
            
            if (password_verify($userPassword, $hashedPassword)) {
                $_SESSION['username'] = $userUsername;
                header("Location: index.php");
                exit;
            } else {
                $_SESSION['invalidPasswd'] = "Nesprávné přihlašovací údaje";
            }
        } else {
            $_SESSION['invalidPasswd'] = "Nesprávné přihlašovací údaje";
        }

        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Přihlasit</title>
</head>
<body>
    <main style="height: 100vh; display: flex; justify-content: center; align-items: center;">
        <div class="login-box">
            <form method="POST">
                <input type="text" name="username" placeholder="Uživatel" style="margin-top: 0;">
                <input type="password" name="password" placeholder="Heslo" style="margin-bottom: 0;">
                <div class="login-confirmation">
                    <button type="submit" class="submit-button fadeinout"><b>Přihlasit</b></button>
                    <p style="color: red;"><?php if (isset($_SESSION['invalidPasswd'])) { echo $_SESSION['invalidPasswd']; unset($_SESSION['invalidPasswd']); } ?></p>
                </div>
            </form>
        </div>
    </main>
</body>
</html>