<?php
session_start();

$is_logged = false;
$debug = false;
$test = "test";

define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'iridium');


//TODO: Security
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} else {
    if($debug)
         echo "succes";
}


//Clean up functions, put on standalone file + add classes if needed
function kill_Mysql() {
     mysql_close($db);
}

function logout() {
    session_destroy();
}

function getNotificationTypeIcon($index, $db) {
    $result = mysqli_query($db, "SELECT type FROM notifications WHERE id=$index limit 1");
    $value = mysqli_fetch_object($result);

    if($value->type == "0")
        return "fa-tasks"; //0 News
    elseif($value->type == "1")
        return "fa-check"; //1 Good
    elseif($value->type == "2")
        return "fa-warning"; //2 Bad
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function getNotificationDate($index, $db) {
    $result = mysqli_query($db, "SELECT date_time FROM notifications WHERE id=$index limit 1");
    $value = mysqli_fetch_object($result);
    return time_elapsed_string($value->date_time);
}

?>