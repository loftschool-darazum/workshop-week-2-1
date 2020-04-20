<?php
use Base\Db;

function createCar()
{
    $marks = [
        'Жигули', 'Mercedes', 'BMW', 'Audi'
    ];
    $gears = [
        GEAR_AUTO => 1,
        GEAR_HAND => 1,
        GEAR_ROBOT => 1,
    ];
    return [
        'mark' => $marks[array_rand($marks)],
        'year' => mt_rand(2000, 2019),
        'color' => COLORS_CONFIG[array_rand(COLORS_CONFIG)]['id'],
        'gear' => array_rand($gears)
    ];
}

function getUser(string $email)
{
    $db = Db::getInstance();
    $select = "SELECT * FROM users WHERE email = :email";
    return $db->fetchOne($select, __METHOD__, [':email' => $email]);
}

function addUser(string $email)
{
    // ...
    return 12345;
}

function addUserOrIncCount(string $email, int $count)
{
    $db = Db::getInstance();
    $sql = "INSERT INTO users (email, orders_count) VALUES (:email, $count)
                ON DUPLICATE KEY UPDATE orders_count = orders_count + $count";
    return $db->exec($sql, __METHOD__, [':email' => $email]);
}

function incOrdersCount(int $count, int $userId)
{
    $db = Db::getInstance();
    $update = "UPDATE users SET orders_count = orders_count + $count WHERE id = $userId";
    return $db->exec($update, __METHOD__);
}

function addOrder(array $orderData)
{
    $db = Db::getInstance();
    $date = date('Y-m-d H:i:s');
    $db->exec(
        "INSERT INTO orders (user_id, `date`, address) VALUES (:user_id,'$date', :address)",
        __FILE__,
        [
            ':user_id' => $orderData['user_id'],
            ':address' => $orderData['address']
        ]
    );

    return $db->lastInsertId();
}