<?php
/**
 * array (size=9)
'name' => string '' (length=0)
'phone' => string '' (length=0)
'email' => string '' (length=0)
'street' => string '' (length=0)
'home' => string '' (length=0)
'part' => string '' (length=0)
'appt' => string '' (length=0)
'floor' => string '' (length=0)
'comment' => string '' (length=0)
 */


ini_set('display_errors', 1);
error_reporting(E_ALL | E_NOTICE);

include __DIR__ . '/../src/config.php';
include __DIR__ . '/../src/functions.php';
include __DIR__ . '/../src/class.db.php';

$email = $_POST['email'] ?? null;
if (!$email) {
    die('please enter email');
}

$user = getUser($email);
if (!$user) {
    $userId = addUser($email);
} else {
    $userId = $user['id'];
}

$addressFields = ['street', 'floot', 'part', 'appt', 'floor'];
addOrder([
    'user_id' => $userId,
    'address' => implode(';', array_intersect_key($_POST, array_fill_keys($addressFields, 1)))
]);