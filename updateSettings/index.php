<?php
// URL of the published Google Doc
$docUrl = 'https://docs.google.com/document/d/e/2PACX-1vROxObEN1GNObqrRSvbGtdnl4BOcOnOpOn2iUKhTbMnZXU6AMEZ9lO6mrAox946LVBWvJbYDahzkMS6/pub';

// Use file_get_contents to fetch the content
$docContent = file_get_contents($docUrl);

// Remove HTML tags and extra spaces
$docContent = strip_tags($docContent);
$docContent = preg_replace('/\s+/', ' ', $docContent);

// Match the lines you're interested in
preg_match_all('/(winter_break_start|winter_break_end|spring_break_start|spring_break_end|summer_break_start|summer_break_end|fall_break_start|fall_break_end|lab_open_start|lab_open_end): \d{2}(-|:)\d{2}/', $docContent, $matches);

// Join the matches with newlines and write to settings.txt
$settings = implode("\n", $matches[0]);
file_put_contents('../settings.txt', $settings);
var_dump($settings);

?>