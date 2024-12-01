<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <script src="../script.js"></script>
    <link rel="stylesheet" href="../style.css">
    <title>TOP107 - režim správce</title>
</head>
<body>
    <header>
        <a href="#" onclick="hamburgerMenuHideOnly()"><img src="../img/logo.png" width="100px" height="100px"></a>
        <a href="logout.php">Odhlasit</a>
    </header>
    <main style="height: 100vh; display: flex; align-items: center; justify-content: center">
        <a class="admin-box-a" href="top107.php"><div class="admin-box"><h2>Správa databáze TOP107</h2></div></a>
        <a class="admin-box-a" href="program.php"><div class="admin-box"><h2>Správa databáze pořadů</h2></div></a>
    </main>
</body>
</html>