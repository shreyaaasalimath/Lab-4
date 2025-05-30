<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Homepage</title>
    <link rel="stylesheet" href="index-style.css">
</head>
<body>

    <h1>Welcome to My Homepage</h1>

    <?php
    // --- 1. Monthly Calendar ---
    function drawCalendar($month, $year) {
        $daysOfWeek = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
        $numberDays = date('t', $firstDayOfMonth);
        $dateComponents = getdate($firstDayOfMonth);
        $dayOfWeek = $dateComponents['wday'];

        echo "<h2>Calendar for {$dateComponents['month']} {$year}</h2>";
        echo "<table><tr>";
        foreach($daysOfWeek as $day) {
            echo "<th>{$day}</th>";
        }
        echo "</tr><tr>";

        if ($dayOfWeek > 0) {
            for ($k = 0; $k < $dayOfWeek; $k++) {
                echo "<td></td>";
            }
        }

        for ($day = 1; $day <= $numberDays; $day++) {
            echo "<td>{$day}</td>";
            $dayOfWeek++;
            if ($dayOfWeek % 7 == 0) {
                echo "</tr><tr>";
            }
        }

        if ($dayOfWeek % 7 != 0) {
            for ($l = $dayOfWeek % 7; $l < 7; $l++) {
                echo "<td></td>";
            }
        }

        echo "</tr></table>";
    }

    $month = date('n');
    $year = date('Y');
    drawCalendar($month, $year);

    // --- 2. Files in Lab 4 Directory ---
    $dir = 'Lab4'; // Change this if your folder name is different

    if (is_dir($dir)) {
        echo "<h2>Files in Lab 4 Directory:</h2><ul>";
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                echo "<li>$file</li>";
            }
        }
        echo "</ul>";
    } else {
        echo "<p>Lab 4 directory not found.</p>";
    }

    // --- 3. Courses from Text File ---
    $filename = 'courses.txt';

    if (file_exists($filename)) {
        echo "<h2>Courses I've Taken So Far:</h2><ul>";
        $courses = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($courses as $course) {
            echo "<li>" . htmlspecialchars($course) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Course list file not found.</p>";
    }
    ?>

</body>
</html>
