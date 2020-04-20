<?php
ini_set('display_errors', 1);
error_reporting(E_ALL | E_NOTICE);

include __DIR__ . '/../src/config.php';
include __DIR__ . '/../src/functions.php';

$cars = [];
for($i = 0; $i < 50; $i++) {
    $cars[] = createCar();
}

//var_dump(json_decode(json_encode($cars), true));

$stats = [];
$fields = array_keys($cars[0]);
foreach ($cars as $car) {
    foreach ($fields as $field) {
        if (!isset($stats[$field][$car[$field]])) {
            $stats[$field][$car[$field]] = 1;
        } else {
            $stats[$field][$car[$field]]++;
        }
    }
}

var_dump($stats);