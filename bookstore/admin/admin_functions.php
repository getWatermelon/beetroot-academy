<?php

require  '../functions.php';

function getMonthes()
{
    return  $monthes = [
        'Январь',
        'Февраль',
        'Март',
        'Апрель',
        'Май',
        'Июнь',
        'Июль',
        'Август',
        'Сентябрь',
        'Отктябрь',
        'Ноябрь',
        'Декабрь'
    ];
}

function getPendingOrders()
{
    $sql = "SELECT count(*) FROM `order` WHERE status ='pending'";
    $pdo = getPDO();
    $stmt = $pdo->query($sql);
    return $stmt->fetch(PDO::FETCH_COLUMN);
}

function getTotalEarnings()
{
    $sql = "SELECT SUM(`amount`) FROM `order` WHERE status ='success'";
    $pdo = getPDO();
    $stmt = $pdo->query($sql);
    return $stmt->fetch(PDO::FETCH_COLUMN);
}

function getEarningLastMonth(){
    $sql = "SELECT month(added_at) mnth, sum(`amount`) total FROM `order` where status='success' group by mnth
            order by mnth desc limit 1
            ";
    $pdo = getPDO();
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $monthes = getMonthes();
    return [ $monthes[$row['mnth'] - 1], $row['total'] ];
}

function getBestMonthEarnings()
{
    $sql = "SELECT month(added_at) mnth, sum(`amount`) total FROM `order` where status='success' group by mnth
            order by total desc limit 1
            ";
    $pdo = getPDO();
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $monthes = getMonthes();
    return [ $monthes[$row['mnth'] - 1], $row['total'] ];
}