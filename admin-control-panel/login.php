<?php
    session_start();
    
    require '../db.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $stmt = $connection->prepare("SELECT password FROM admin_login WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();
            
            if (password_verify($password, $hashed_password)) {
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit;
            } else {
                $_SESSION['invalidPasswd'] = "Nesprávné přihlašovací údaje";
            }
        } else {
            $_SESSION['invalidPasswd'] = "Nesprávné přihlašovací údaje";
        }
        
        $stmt->close();
        header("Location: login.php");
        exit;
    }
    $connection->close();
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
                <input type="text" name="username" placeholder="Uživatel">
                <input type="password" name="password" placeholder="Heslo">
                <div class="login-confirmation">
                    <button type="submit" class="login-button"><b>Přihlasit</b></button>
                    <p style="color: red;"><?php if (isset($_SESSION['invalidPasswd'])) { echo $_SESSION['invalidPasswd']; unset($_SESSION['invalidPasswd']); } ?></p>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
