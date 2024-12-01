<?php
    require 'php_scripts/db.php';

    date_default_timezone_set("Europe/Prague");
    $selectedDay = isset($_GET['day']) ? $_GET['day'] : date("N");

    $programSchedule = "SELECT DATE_FORMAT(time_start, '%H:%i') AS time_start, DATE_FORMAT(time_end, '%H:%i') AS time_end, program_name FROM program_schedule WHERE program_schedule.day = ? ORDER BY program_schedule.day, program_schedule.time_start";
    $programSchedule = $connection->prepare($programSchedule);
    $programSchedule->bind_param("i", $selectedDay);
    $programSchedule->execute();
    $programScheduleResult = $programSchedule->get_result();

    $topStandings = "SELECT * FROM top107 ORDER BY votes DESC LIMIT 3";
    $topStandingsResult = $connection->query($topStandings);
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="free, radio, freeradio, brno">
    <meta name="description" content="Free Rádio 107 FM. První v Brně s nejnovějšími hity!">
    <title>Free Rádio 107 FM | První v Brně s nejnovějšími hity!</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <script src="script.js"></script>
</head>
<body>
    <audio id="audio" src="https://icecast8.play.cz/freeradio128.mp3" preload="none"></audio>
    <header>
        <a href="#" onclick="hamburgerMenuHideOnly()"><img src="img/logo.png" width="100px" height="100px"></a>
        <nav class="menu-desktop">
            <a href="#program">Pořady</a>
            <a href="#team">Náš team</a>
            <a href="#kontakt">Kontakt</a>
            <a href="#jak-nas-naladit">Jak nás naladit</a>
            <a class="fadeinout" href="top107"><b>TOP 107</b></a>
        </nav>
        <nav class="menu-mobile"><i class="fa fa-bars menu-mobile-icon" onclick="hamburgerMenu()"></i></nav>
    </header>
    <main>
        <div id="myLinks" onclick="hamburgerMenu()">
            <a href="#program">Pořady</a>
            <a href="#team">Náš team</a>
            <a href="#kontakt">Kontakt</a>
            <a href="#jak-nas-naladit">Jak nás naladit</a>
            <a href="top107"><b>TOP 107</b></a>
        </div>
        <section id="main">
            <div class="left">
                <div class="box-play"><i id="playPauseBtn" class="fa-solid fa-circle-play" style="cursor: pointer;"></i><h2>Poslouchej nás online</h2></div>
                <div id="program" class="program">
                    <h2 style="margin-bottom: 30px; text-align: center;">Pořady</h2>
                    <select id="program-days" class="dropdown" onchange="updateDay()">
                        <option value="1" <?php $selectedDay == '1'; ?>>Ponděli</option>
                        <option value="2" <?php $selectedDay == '2'; ?>>Úterý</option>
                        <option value="3" <?php $selectedDay == '3'; ?>>Středa</option>
                        <option value="4" <?php $selectedDay == '4'; ?>>Čtvrtek</option>
                        <option value="5" <?php $selectedDay == '5'; ?>>Pátek</option>
                        <option value="6" <?php $selectedDay == '6'; ?>>Sobota</option>
                        <option value="7" <?php $selectedDay == '7'; ?>>Neděle</option>
                    </select>

                    <div class="daySchedule">
                        <?php if ($programScheduleResult->num_rows > 0): ?>
                            <h2><?php if ($selectedDay === '1'): echo 'Ponděli'; elseif ($selectedDay === '2'): echo 'Úterý'; elseif ($selectedDay === '3'): echo 'Středa'; elseif ($selectedDay === '4'): echo 'Čtvrtek'; elseif ($selectedDay === '5'): echo 'Pátek'; elseif ($selectedDay === '6'): echo 'Sobota'; elseif ($selectedDay === '7'): echo 'Neděle'; endif; ?></h2>
                            <?php while($row = $programScheduleResult->fetch_assoc()): ?>
                                <p><b><?php echo $row['time_start']; ?> - <?php echo $row['time_end']; ?></b>&nbsp;&nbsp;<?php echo $row['program_name']; ?></p>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p style="text-align: center;">Databáze pořadů je prázdná.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="right">
                <div id="partneri" class="partners">
                    <h2 style="margin-bottom: 30px; text-align: center;">Partneři webu</h2>
                    <div style="margin-bottom: 10px;">
                        <a href="https://www.ndbrno.cz/" target="_blank"><div><img class="fadeinout" src="img/ndb.png" width="150px" style="border-radius: 25px;"></div></a>
                    </div>
                </div>
                <div id="top107" class="top107">
                    <h2 style="margin-bottom: 30px; text-align: center;">TOP 107</h2>
                    <div class="top107-glance">
                        <?php $counter = 1; ?>
                        <?php if ($topStandingsResult->num_rows > 0): ?>
                            <?php while($row = $topStandingsResult->fetch_assoc()): ?>
                                <div class="topEntry">
                                    <p><b><?php echo $counter; ?></b>&nbsp; • &nbsp;<?php echo $row['artist']; ?>&nbsp; - &nbsp;<?php echo $row['title']; ?></p>
                                </div>
                                <?php $counter++; ?>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p style="text-align: center;">Databáze skladeb je prázdná.</p>
                        <?php endif; ?>
                    </div>
                    <a href="top107" style="margin-top: 30px;"><p><b>Zobrazit celou hitparádu</b>&nbsp;&nbsp;<i class="fa-solid fa-arrow-right"></i></p></a>
                </div>
            </div>
        </section>
        <section id="main2">
            <div id="team" class="team">
                <h2 style="margin-bottom: 30px; text-align: center;">Team Free Rádia</h2>
                <div class="team-container">
                    <div><img src="img/team-roman-kolodej.jpg"><p>Roman Koloděj</p></div>
                    <div><img src="img/team-petra-hlavkova.jpg"><p>Petra Hlávková</p></div>
                    <div><img src="img/team-kristyna-kolibova.jpg"><p>Kristýna Kolibová</p></div>
                    <div><img src="img/team-lukas-bartl.jpg"><p>Lukáš Bartl</p></div>
                    <div><img src="img/team-patrick-netik.jpg"><p>Patrick Netík</p></div>
                    <div><img src="img/team-misa-rotterova.jpg"><p>Míša Rotterová</p></div>
                    <div><img src="img/team-mekki-martin.jpg"><p>Martin Mekki</p></div>
                </div>
            </div>
            <div id="kontakt" class="contact">
                <h2 style="margin-bottom: 30px; text-align: center;">Kontakt</h2>
                <div class="helper-container">
                    <div class="left">
                        <iframe style="border: none; border-radius: 15px;" src="https://frame.mapy.cz/s/mufagodare" width="470" height="350" frameborder="0"></iframe>
                    </div>
                    <div class="right">
                        <p>Studio tel.: <a class="highlight" href="tel:+420790107107">+420 790 107 107</p></a>
                        <p>Studio mail: <a class="highlight" href="mailto:studio@freeradio.cz">studio@freeradio.cz</a></p>
                        <p class="bottom">Freečko najdete na adrese Gorkého 45, pod jednou střechou společně s Krokodýlem.</p>
                    </div>
                </div>
            </div>
            <div id="jak-nas-naladit" class="broadcast">
                <h2 style="margin-bottom: 30px; text-align: center;">Jak nás naladit?</h2>
                <div class="helper-container">
                    <div class="left">
                        <a href="img/pokryti.png" target="_blank"><img src="img/pokryti.png" style="width: 100%; border-radius: 15px;"></a>
                    </div>
                    <div class="right">
                        <p>V Brně vysíláme na frekvenci 107 MHz. Můžete nás naladit také tady na našich webových stránkách nebo přímo skrze webstream:</p><a class="highlight" href="https://icecast8.play.cz/freeradio128.mp3" target="_blank">https://icecast8.play.cz/freeradio128.mp3</a>
                    </div>
                </div>
            </div>
        </section>
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
</body>
</html>

<script>
    date = new Date();
    day = date.getDay();
    convertedDay = day === 0 ? 7 : day;
    document.getElementById('program-days').value = convertedDay;

    function updateDay() {
        dropdown = document.getElementById('program-days');
        selectedDay = dropdown.value;

        fetch(`php_scripts/schedule.php?day=${selectedDay}`)
        .then(response => response.json())
        .then(schedule => {
            const dayScheduleDiv = document.querySelector('.daySchedule');
            dayScheduleDiv.innerHTML = `<h2>${getDayName(selectedDay)}</h2>`;

            schedule.forEach(item => {
                dayScheduleDiv.innerHTML += `<p><b>${item.time_start} - ${item.time_end}</b>&nbsp;&nbsp;${item.program_name}</p>`;
            });
        });
    }

    function getDayName(day) {
        switch(day) {
            case '1': return 'Ponděli';
            case '2': return 'Úterý';
            case '3': return 'Středa';
            case '4': return 'Čtvrtek';
            case '5': return 'Pátek';
            case '6': return 'Sobota';
            case '7': return 'Neděle';
        }
    }

    audio = document.getElementById('audio');
    playPauseBtn = document.getElementById('playPauseBtn');

    function togglePlayPause() {
        if (audio.paused) {
            audio.src = audio.src + '?cachebust=' + new Date();
            audio.play();
            playPauseBtn.classList.remove('fa-circle-play');
            playPauseBtn.classList.add('fa-circle-pause');
        } else {
            audio.pause();
            audio.src = audio.src + '?cachebust=' + new Date();
            playPauseBtn.classList.remove('fa-circle-pause');
            playPauseBtn.classList.add('fa-circle-play');
        }
    }

    playPauseBtn.addEventListener('click', togglePlayPause);
</script>
