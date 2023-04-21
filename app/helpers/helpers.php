<?php
function redirect($location) {
    header("Location: " . URLROOT . $location);
}

function getDateFormatter($date) {
    $date2 = date_create($date);
    return date_format($date2, "F j, Y");
}

function getTimeDescription() {
    date_default_timezone_set('America/Chicago');
    $currentHour = intval(date("H"));
    if($currentHour < 5){
        return "night";
    } else if($currentHour < 12){
        return "morning";
    } else if($currentHour < 17){
        return "afternoon";
    } else if($currentHour < 22){
        return "evening";
    } else {
        return "night";
    }
}

function excerpt($text, $phrase, $radius = 100, $ending = "...") {
    //https://stackoverflow.com/a/1404151
    $phraseLen = strlen($phrase);
    if ($radius < $phraseLen) {
        $radius = $phraseLen;
    }

    $phrases = explode (' ',$phrase);

    foreach ($phrases as $phrase) {
        $pos = strpos(strtolower($text), strtolower($phrase));
        if ($pos > -1) break;
    }

    $startPos = 0;
    if ($pos > $radius) {
        $startPos = $pos - $radius;
    }

    $textLen = strlen($text);

    $endPos = $pos + $phraseLen + $radius;
    if ($endPos >= $textLen) {
        $endPos = $textLen;
    }

    $excerpt = substr($text, $startPos, $endPos - $startPos);
    if ($startPos != 0) {
        $excerpt = substr_replace($excerpt, $ending, 0, $phraseLen);
    }

    if ($endPos != $textLen) {
        $excerpt = substr_replace($excerpt, $ending, -$phraseLen);
    }

    return $excerpt;
}

function sanitize($str) {
    return htmlspecialchars(trim($str));
}