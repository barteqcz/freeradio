<?php
    session_start();
    
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
    
    require '../db.php';
    
    if (isset($_GET['delete'])) {
        $idToDelete = (int)$_GET['delete'];
        $deleteStmt = $connection->prepare("DELETE FROM program_schedule WHERE id = ?");
        $deleteStmt->bind_param("i", $idToDelete);
        $deleteStmt->execute();
        $deleteStmt->close();
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['editId'])) {
        $day = $_POST['day'];
        $time_start = $_POST['time_start'];
        $time_end = $_POST['time_end'];
        $program_name = $_POST['program_name'];
    
        $insertNewSongs = $connection->prepare("INSERT INTO program_schedule (day, time_start, time_end, program_name) VALUES (?, ?, ?, ?)");
        $insertNewSongs->bind_param("isss", $day, $time_start, $time_end, $program_name);
    
        if ($insertNewSongs->execute()) {
            $_SESSION['addSuccess'] = 1; 
        }
    
        $insertNewSongs->close();
    
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    
    if (isset($_POST['editId'])) {
        $editId = $_POST['editId'];
        $updatedDay = $_POST['day'];
        $updatedTime_start = $_POST['time_start'];
        $updatedTime_end = $_POST['time_end'];
        $updatedProgram_name = $_POST['program_name'];
    
        $updateStmt = $connection->prepare("UPDATE program_schedule SET day = ?, time_start = ?, time_end = ?, program_name = ? WHERE id = ?");
        $updateStmt->bind_param("ssssi", $updatedDay, $updatedTime_start, $updatedTime_end, $updatedProgram_name, $editId);
        $updateStmt->execute();
        $updateStmt->close();
    
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    
        if (!isset($_SESSION['username'])) {
            header("Location: login.php");
            exit;
        }
    }
    
    $result = $connection->query("SELECT * FROM program_schedule ORDER BY day, time_start");
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Pořady - režim správce</title>
</head>
<body>
    <header>
        <a href="index.php" onclick="hamburgerMenuHideOnly()"><img src="../img/logo.png" width="100px" height="100px"></a>
        <a href="logout.php">Odhlasit</a>
    </header>
    <main style="display: flex; align-items: center; margin-top: 200px; margin-bottom: 50px;">
        <div class="setup-box">
            <form method="post">
                <select class="dropdown2" name="day">
                    <option value="1">Ponděli</option>
                    <option value="2">Úterý</option>
                    <option value="3">Středa</option>
                    <option value="4">Čtvrtek</option>
                    <option value="5">Pátek</option>
                    <option value="6">Sobota</option>
                    <option value="7">Neděle</option>
                </select>
                <input type="text" id="time_start" name="time_start" placeholder="Čas" required>
                <input type="text" id="time_end" name="time_end" placeholder="Čas" required>
                <input type="text" id="program_name" name="program_name" placeholder="Název pořadu" required>
                <input type="submit" value="Přidat" style="cursor: pointer; margin-top: 30px;">
            </form>
            <p><?php if (isset($_SESSION['addSuccess']) && $_SESSION['addSuccess'] == 1) { echo "Úspěšně přidáno skladbu do databáze"; unset($_SESSION['addSuccess']); } ?></p>

            <div class="setup-box-card-container">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="setup-box-card" id="row-<?php echo $row['id']; ?>">
                                <div class="setup-box-card-content">
                                    <p><strong>Den:</strong> <?php echo htmlspecialchars($row['day']); ?></p>
                                    <p><strong>Čas:</strong> <?php echo htmlspecialchars($row['time_start']) . ' - ' . htmlspecialchars($row['time_end']); ?></p>
                                    <p><strong>Pořad:</strong> <?php echo htmlspecialchars($row['program_name']); ?></p>
                                </div>
                                <div class="edit-delete">
                                    <button type="button" class="edit-button" onclick="toggleEdit(<?php echo $row['id']; ?>)">Upravit</button>
                                    <a href="?delete=<?php echo $row['id']; ?>"><button type="button" class="edit-button">Smazat</button></a>
                                </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="setup-box-card">
                        <p>Žádné záznamy nenalezeny.</p>
                    </div>
                <?php endif; ?>
            </div>
            <form id="editForm" method="post" style="display:none;">
                <input type="hidden" id="editId" name="editId">
                <input type="text" id="dayInput" name="day" placeholder="Den" required>
                <input type="text" id="time_startInput" name="time_start" placeholder="Čas" required>
                <input type="text" id="time_endInput" name="time_end" placeholder="Čas" required>
                <input type="text" id="program_nameInput" name="program_name" placeholder="Název pořadu" required>
            </form>
        </div>
    </main>
</body>
</html>

<script>
function toggleEdit(id) {
    const row = document.getElementById('row-' + id);
    const editButton = row.querySelector('.edit-button');
    const isEditing = editButton.innerText === 'Uložit';

    if (isEditing) {
        // In editing mode: Save the values from the inputs
        const dayInput = row.querySelector('select[name="day"]').value;  // Now select instead of input
        const time_startInput = row.querySelector('input[name="time_start"]').value;
        const time_endInput = row.querySelector('input[name="time_end"]').value;
        const program_nameInput = row.querySelector('input[name="program_name"]').value;

        document.getElementById('editId').value = id;
        document.getElementById('dayInput').value = dayInput;
        document.getElementById('time_startInput').value = time_startInput;
        document.getElementById('time_endInput').value = time_endInput;
        document.getElementById('program_nameInput').value = program_nameInput;
        
        document.getElementById('editForm').submit();
    } else {
        const day = row.querySelector('p:nth-child(1)');
        const time = row.querySelector('p:nth-child(2)');
        const program_name = row.querySelector('p:nth-child(3)');

        const dayValue = day.textContent.split(': ')[1]?.trim() || '';
        const timeValues = time.textContent.split(': ')[1]?.trim().split(' - ') || ['', ''];
        const time_startValue = timeValues[0]?.trim() || '';
        const time_endValue = timeValues[1]?.trim() || '';
        const program_nameValue = program_name.textContent.split(': ')[1]?.trim() || '';

        day.innerHTML = `<select class="dropdown2" name="day">
            <option value="1" ${dayValue === '1'}>Ponděli</option>
            <option value="2" ${dayValue === '2'}>Úterý</option>
            <option value="3" ${dayValue === '3'}>Středa</option>
            <option value="4" ${dayValue === '4'}>Čtvrtek</option>
            <option value="5" ${dayValue === '5'}>Pátek</option>
            <option value="6" ${dayValue === '6'}>Sobota</option>
            <option value="7" ${dayValue === '7'}>Neděle</option>
        </select>`;

        time.innerHTML = `
            <div style="display: flex; gap: 5px; align-items: center;">
                <input type="text" name="time_start" value="${time_startValue}" required> - <input type="text" name="time_end" value="${time_endValue}" required>
            </div>
        `;

        program_name.innerHTML = `<input type="text" name="program_name" value="${program_nameValue}" required>`;

        editButton.innerText = 'Uložit';
    }
}
</script>