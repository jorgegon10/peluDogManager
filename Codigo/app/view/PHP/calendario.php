<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="../CSS/calendario.css">
</head>
<body>
        <?php   include "../Generales/nav.php";   ?>
    <div class="calendar-container">
        <?php
        $month = isset($_GET['month']) ? $_GET['month'] : date('m');
        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

        $firstDay = mktime(0, 0, 0, $month, 1, $year);
        $daysInMonth = date('t', $firstDay);
        $dayOfWeek = date('w', $firstDay);
        $monthName = date('F Y', $firstDay);
        
        ?>

        <div class="calendar-header">
            <a href="?month=<?= $month-1 ?>&year=<?= $year ?>" class="nav-btn">&lt;</a>
            <h2><?= $monthName ?></h2>
            <a href="?month=<?= $month+1 ?>&year=<?= $year ?>" class="nav-btn">&gt;</a>
        </div>

        <div class="calendar">
            <div class="weekdays">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>

            <div class="days">
                <?php
                for($i = 0; $i < $dayOfWeek; $i++) {
                    echo "<div class='day empty'></div>";
                }

                for($day = 1; $day <= $daysInMonth; $day++) {
                    $class = date('Y-m-d') === date('Y-m-d', mktime(0, 0, 0, $month, $day, $year)) 
                        ? 'day current' 
                        : 'day';
                    echo "<div class='$class'>$day</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>