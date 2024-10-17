<?php
    require 'db.php';

    date_default_timezone_set("Europe/Prague");
    $selectedDay = isset($_GET['day']) ? $_GET['day'] : date("N");

    $getProgramSchedule = $connection->prepare("SELECT time_start, time_end, program_name FROM program_schedule WHERE day = ? ORDER BY day, time_start");
    $getProgramSchedule->bind_param("i", $selectedDay);
    $getProgramSchedule->execute();
    $getProgramScheduleResult = $getProgramSchedule->get_result();

    if ($getProgramScheduleResult->num_rows > 0) {
        $schedule = [];
        while ($row = $getProgramScheduleResult->fetch_assoc()) {
            $schedule[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($schedule);
    }
?>
