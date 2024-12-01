<?php
    require 'db.php';

    date_default_timezone_set("Europe/Prague");
    $selectedDay = isset($_GET['day']) ? $_GET['day'] : date("N");

    // Prepare the query
    $programSchedule = $connection->prepare("SELECT DATE_FORMAT(time_start, '%H:%i') AS time_start, DATE_FORMAT(time_end, '%H:%i') AS time_end, program_name FROM program_schedule WHERE day = ? ORDER BY day, time_start");
    $programSchedule->bind_param("i", $selectedDay);
    $programSchedule->execute();
    $programScheduleResult = $programSchedule->get_result();

    // Check if there are results
    if ($programScheduleResult->num_rows > 0) {
        $schedule = [];
        // Fetch the results
        while ($row = $programScheduleResult->fetch_assoc()) {
            $schedule[] = $row;
        }

        // Set the response header to JSON
        header('Content-Type: application/json');
        echo json_encode($schedule);
    } else {
        // If no results, return an empty array
        header('Content-Type: application/json');
        echo json_encode([]);
    }
?>