<?php
    require '../db.php';

    $userIp = $_SERVER['REMOTE_ADDR'];

    $getVotingData = "SELECT * FROM top107 ORDER BY top107.votes DESC";
    $getVotingDataResult = $connection->query($getVotingData);

    function canVote($connection, $userIp) {
        $currentDate = date('Y-m-d');

        $query = "SELECT COUNT(*) as vote_count FROM ip_votes WHERE ip_address = ? AND DATE(vote_time) = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ss", $userIp, $currentDate);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return ($row['vote_count'] < 7);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $songId = $_POST['id'];

        if (canVote($connection, $userIp)) {
            $stmt = $connection->prepare("UPDATE top107 SET votes = votes + 1 WHERE id = ?");
            $stmt->bind_param("i", $songId);
            $stmt->execute();
            $stmt->close();

            $stmt = $connection->prepare("INSERT INTO ip_votes (ip_address, song_id) VALUES (?, ?)");
            $stmt->bind_param("si", $userIp, $songId);
            $stmt->execute();
            $stmt->close();

            echo json_encode(['voteSuccess' => 1]);
        } else {
            echo json_encode(['voteSuccess' => 0]);
        }
        exit;
    }
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="top107, freeradio, free">
    <meta name="description" content="Stosedmíčka Freečka. Hlasujte na své oblibené pisničky.">
    <title>TOP 107 | Free Rádio 107 FM</title>
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <a href="../" onclick="hamburgerMenuHideOnly()"><img src="../img/logo.png" width="100px" height="100px"></a>
    </header>
    <main id="main">
        <h1 style="text-align: center; margin-bottom: 50px;">TOP 107 Free Rádia</h1>
        <p style="text-align: center;">Vy tvoříte Freečko, tak nám dejte vědět, co se Vám líbí. Hlasovat můžete až pro 7 různých songů denně!</p>
        <?php if ($getVotingDataResult->num_rows > 0): ?>
        <?php $counter = 1; ?>
        <?php while($row = $getVotingDataResult->fetch_assoc()): ?>
            <div class="songEntry">
                <div class="songEntryLeft">
                    <h1><?php echo $counter; ?></h1>
                </div>
                <div class="songEntryMid">
                    <h1><?php echo $row['title']; ?></h1>
                    <p><?php echo $row['artist']; ?></p>
                </div>
                <button class="vote-button fadeinout" data-id="<?php echo $row['id']; ?>"><b>Hlasuj</b></button>
            </div>
            <?php $counter++; ?>
        <?php endwhile; ?>
    <?php else: ?>
        <h1 style="text-align: center;">Databáze skladeb je prázdná</h1>
    <?php endif; ?>
    </main>
    <footer>
        <div class="footer-left">
            <p>&copy; 2024 Free Rádio Brno</p>
        </div>
        <div class="footer-right">
            <a href="https://www.facebook.com/freeradio/" target="_blank"><i class="fadeinout fa-brands fa-facebook"></i></a>
            <a href="https://www.instagram.com/freeradio.cz/" target="_blank"><i class="fadeinout fa-brands fa-instagram"></i></a>
        </div>
    </footer>
    <div id="voting-div-success">
        <p><b>Váš hlas byl uspěšně uložen!</b></p>
    </div>
    <div id="voting-div-error">
        <p><b>Překročili jste hlasovací limit (můžete hlasovat maximálně 7krát denně).</b></p>
    </div>
</body>
</html>

<script>
    const voteButtons = document.querySelectorAll('.vote-button');

    voteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const songId = this.getAttribute('data-id');
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + encodeURIComponent(songId)
            }).then(response => response.json()).then(data => {
                const voteSuccessDiv = document.getElementById('voting-div-success');
                const voteErrorDiv = document.getElementById('voting-div-error');
                if (data.voteSuccess === 1) {
                    voteSuccessDiv.classList.add('show');
                    setTimeout(function() {
                        voteSuccessDiv.classList.remove('show');
                    }, 2000);
                } else {
                    voteErrorDiv.classList.add('show');
                    setTimeout(function() {
                        voteErrorDiv.classList.remove('show');
                    }, 3000);
                }
            });
        });
    });
</script>
