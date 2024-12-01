<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    require '../php_scripts/db.php';

    if (isset($_GET['delete'])) {
        $idToDelete = (int)$_GET['delete'];
        $deleteSong = $connection->prepare("DELETE FROM top107 WHERE top107.id = ?");
        $deleteSong->bind_param("i", $idToDelete);
        $deleteSong->execute();
        $deleteSong->close();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['editId'])) {
        $artist = $_POST['artist'];
        $title = $_POST['title'];

        $insertNewSongs = $connection->prepare("INSERT INTO top107 (artist, title) VALUES (?, ?)");
        $insertNewSongs->bind_param("ss", $artist, $title);

        if ($insertNewSongs->execute()) {
            $_SESSION['addSuccess'] = 1;
        }

        $insertNewSongs->close();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if (isset($_POST['editId'])) {
        $editId = $_POST['editId'];
        $updatedArtist = $_POST['artist'];
        $updatedTitle = $_POST['title'];

        $updateSong = $connection->prepare("UPDATE top107 SET top107.artist = ?, top107.title = ? WHERE top107.id = ?");
        $updateSong->bind_param("ssi", $updatedArtist, $updatedTitle, $editId);
        $updateSong->execute();
        $updateSong->close();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();

        if (!isset($_SESSION['username'])) {
            header("Location: login.php");
            exit;
        }
    }

    $result = $connection->query("SELECT * FROM top107 ORDER BY top107.votes DESC");
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>TOP107 - režim správce</title>
</head>
<body>
    <header>
        <a href="index.php" onclick="hamburgerMenuHideOnly()"><img src="../img/logo.png" width="100px" height="100px"></a>
        <a href="logout.php">Odhlasit</a>
    </header>
    <main style="display: flex; align-items: center; margin-top: 200px; margin-bottom: 50px;">
        <div class="setup-box">
            <form method="post">
                <input type="text" id="artist" name="artist" placeholder="Umělec" required>
                <input type="text" id="title" name="title" placeholder="Název skladby" required>
                <button type="submit" class="submit-button fadeinout" style="margin-top: 30px;">Přidat</button>
            </form>
            <p><?php if (isset($_SESSION['addSuccess']) && $_SESSION['addSuccess'] == 1) { echo "Úspěšně přidáno skladbu do databáze"; unset($_SESSION['addSuccess']); } ?></p>

            <div class="setup-box-card-container">
                <?php if ($result->num_rows > 0): ?>
                <?php $counter = 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="setup-box-card" id="row-<?php echo $row['id']; ?>">
                            <div class="setup-box-card-content">
                                <p><strong>Místo:</strong> <?php echo $counter; ?></p>
                                <p><strong>Hlasy:</strong> <?php echo $row['votes']; ?></p>
                                <p><strong>Umělec:</strong> <?php echo $row['artist']; ?></p>
                                <p><strong>Název skladby:</strong> <?php echo $row['title']; ?></p>
                            </div>
                            <div class="edit-delete">
                                <a class="edit-button" onclick="toggleEdit(<?php echo $row['id']; ?>)">Upravit</button>
                                <a href="?delete=<?php echo $row['id']; ?>"><button type="button" class="edit-button">Smazat</button></a>
                            </div>
                        </div>
                        <?php $counter++; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="setup-box-card">
                        <p>Žádné záznamy nenalezeny.</p>
                    </div>
                <?php endif; ?>
            </div>
            <form id="editForm" method="post" style="display: none;">
                <input type="hidden" id="editId" name="editId">
                <input type="text" id="artistInput" name="artist" placeholder="Umělec" required>
                <input type="text" id="titleInput" name="title" placeholder="Název skladby" required>
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
            const artistInput = row.querySelector('input[name="artist"]').value;
            const titleInput = row.querySelector('input[name="title"]').value;

            document.getElementById('editId').value = id;
            document.getElementById('artistInput').value = artistInput;
            document.getElementById('titleInput').value = titleInput;
            document.getElementById('editForm').submit();
        } else {
            const artistParagraph = row.querySelector('p:nth-child(3)');
            const titleParagraph = row.querySelector('p:nth-child(4)');

            const artistValue = artistParagraph.textContent.split(': ')[1]?.trim() || '';
            const titleValue = titleParagraph.textContent.split(': ')[1]?.trim() || '';

            artistParagraph.innerHTML = `<input type="text" name="artist" value="${artistValue}" required>`;
            titleParagraph.innerHTML = `<input type="text" name="title" value="${titleValue}" required>`;
            editButton.innerText = 'Uložit';
        }
    }
</script>
