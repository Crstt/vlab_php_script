<?php
// Program:      Timed Link Redirect
// Author:       Jeremy Nally, Matteo Catalano
// Created:      2020-10-16
// Last Updated: 2022-01-10
// Purpose:      To direct students to virtual labs within certain time frames
//               and direct them to an information page outside of those times.
//               This version is for the CAE Virtual Lab.
// 2020-10-19:   Added 5 minute opening before official start time. - JAN
// 2021-02-03:   Adapted for use with the virtual lab.
// 2024-01-16:   Complete refactor. Added settings.txt file to store settings. Added ability to change settings via Google Doc. Added redirect screen

// Target URLs
//$labURL1 = "https://www.google.com/a/ivytech.edu/ServiceLogin?continue=https://script.google.com/a/macros/ivytech.edu/s/AKfycbzoQHwQlTwLWwSoHo7jF-1V3IfgOKcu_BrWPd-uW21Ru7YwlOr9EEKGIhdvnorYC2ufVQ/exec?id=1";
$labURL1 = "https://script.google.com/a/macros/ivytech.edu/s/AKfycbwscWT353NYd3kHmlSqkumEvnF4J2d4iNa77gX6BmuFj81oJ5zRoMHeLxYPDIPz_ydVhQ/exec";
$infoURL = "https://sites.google.com/ivytech.edu/cae/drop-in-lab-closed";
$campusClosureURL = "https://sites.google.com/ivytech.edu/cae/campus-closed-drop-in-lab-closed";

// Get time information
date_default_timezone_set('US/Eastern'); // Set timezone
$H = date("H"); // Get hour in 24 hour format
$w = date("w"); // Get weekday as number
$i = date("i"); // Get minute
$d = date("d"); // Get day of the month
$m = date("m"); // Get month number

$settings = array();
$lines = file('settings.txt');

foreach ($lines as $line) {
        list($key, $value) = explode(': ', trim($line));
        $settings[$key] = $value;
}

// Now you can use the settings in your code
list($day, $month) = explode('-', $settings['winter_break_start']);
$isWinterBreakStart = $d >= $day && $m == $month;

// Do the same for the other settings
// Begin HTML
echo <<<HEREDOC
<!DOCTYPE html>
<html>\n
HEREDOC;

//var_dump($settings);echo "<br>";

$isWinterBreak = isWithinDateRange($m, $d, $settings['winter_break_start'], $settings['winter_break_end']); // Campus closed for winter break
$isSpringBreak = isWithinDateRange($m, $d, $settings['spring_break_start'], $settings['spring_break_end']);
$isSummerBreak = isWithinDateRange($m, $d, $settings['summer_break_start'], $settings['summer_break_end']);
$isFallBreak = isWithinDateRange($m, $d, $settings['fall_break_start'], $settings['fall_break_end']);

$isOpenTime = isWithinTimeRange($H, $i, $settings['lab_open_start'], $settings['lab_open_end']);

function isWithinDateRange($month, $day, $start, $end){
        list($startMonth, $startDay) = explode('-', $start);
        list($endMonth, $endDay) = explode('-', $end);
        return $month >= $startMonth && $day >= $startDay && $month <= $endMonth && $day <= $endDay;
}

function isWithinTimeRange($hour, $minute, $start, $end){
        list($startHour, $startMinute) = explode(':', $start);
        list($endHour, $endMinute) = explode(':', $end);
        
        return ($hour == $startHour && $minute >= $startMinute) || ($hour > $startHour && ($hour < $endHour || ($hour == $endHour && $minute <= $endMinute)));
}

/*var_dump($H, $i, $w, $d, $m);
echo "isWinterBreakStart: " . ($isWinterBreakStart ? 'true' : 'false') . "<br>";
echo "isWinterBreak: " . ($isWinterBreak ? 'true' : 'false') . "<br>";
echo "isSpringBreak: " . ($isSpringBreak ? 'true' : 'false') . "<br>";
echo "isSummerBreak: " . ($isSummerBreak ? 'true' : 'false') . "<br>";
echo "isFallBreak: " . ($isFallBreak ? 'true' : 'false') . "<br>";
echo "isOpenTime: " . ($isOpenTime ? 'true' : 'false') . "<br>";
if($isWinterBreak){
        echo "Campus Closed<br>";
}elseif($isOpenTime){
        echo "Open Time<br>";
}else{
        echo "Lab Closed<br>";
}
die();*/

// Route user to campus closure page if campus is closed
if($isWinterBreak){
        echo "    <meta http-equiv=\"refresh\" content=\"0; URL='$campusClosureURL'\" />\n";
}elseif($isOpenTime){
        echo "    <meta http-equiv=\"refresh\" content=\"0; URL='$labURL1'\" />\n";
}else{
        echo "    <meta http-equiv=\"refresh\" content=\"0; URL='$infoURL'\" />\n";
}
// Finish HTML
echo <<<HEREDOC
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Center for Academic Excellence</title>
        <link type="text/css" rel="stylesheet" media="screen" href="cae.css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <style>
                .spinner {
                        margin: 0 auto;
                        width: 100vw; /* occupy the full width of the viewport */
                        height: 50vh; /* occupy the full height of the viewport */
                        position: relative;
                        text-align: center;
                        animation: rotate 2s infinite linear;
                }
                
                .spinner:before {
                        content: '';
                        display: block;
                        margin: 0 auto;
                        width: 10%;
                        height: 10%;
                        background-color: #333;
                        border-radius: 50%;
                        animation: bounce 2s infinite ease-in-out;
                }
                
                @keyframes rotate {
                        100% {
                                transform: rotate(360deg);
                        }
                }
                
                @keyframes bounce {
                        0%, 100% {
                                transform: scale(0);
                        }
                        50% {
                                transform: scale(1);
                        }
                }
        </style>
</head>
<body>
        <header style=" display: flex; justify-content: center;">
            <img src="TutoringServicesLogo.png" style="height: 20vh;display: flex;/* justify-content: center; */" alt="Header Image">
        </header>
        
        <div style="height: 10vh;font-size: 30px;display: flex;justify-content: center;">
                <p>Please give us just a moment while we load your Ivy Tech course information.</p>
        </div>
        
        <div class="spinner"></div>
</body>
</html>\n
HEREDOC;
?>
