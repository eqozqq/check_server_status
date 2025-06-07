<?php
header("Access-Control-Allow-Origin: https://legacyminecraftpe.github.io/");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$ip = $_GET['ip'];
$port = $_GET['port'];
$fp = fsockopen("udp://$ip", $port, $errno, $errstr, 1);
if(!$fp) {
    echo "Offline";
} else {
    stream_set_timeout($fp, 1, 0);
    fwrite($fp, "\x01\x00\x00\x00\x00\x00\x00\x00\xff\x00\xff\xff\x00\xfe\xfe\xfe\xfe\xfd\xfd\xfd\xfd\x12\x34\x56\x78");
    if(strlen(fgets($fp, 16)) <=0) {
        echo "Offline";
    } else {
        echo "Online";
    }
}
?>
