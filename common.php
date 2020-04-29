<?php

// エスケープ処理
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}


// データベースに接続
// @return \PDO
function connect_db()
{
    $dsn = 'mysql:host=localhost; dbname=original_app; charset=utf8mb4';
    $username = 'root';
    $password = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    return new PDO($dsn, $username, $password, $options);
}


// insert
// @param string $sql
// @param array $arr
// @return int lastInsertId
function insert($sql, $arr = [])
{
    $pdo = connect_db();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arr);
    return $pdo->lastInsertId();
}


// select
// @param string $sql
// @param array $arr
// @return array $rows
// function select($sql, $arr = [])
// {
//     $pdo = connect_db();
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute($arr);
//     return $stmt->fetchAll();
// }

// delete
// @param string $sql
// @param array $arr
// @return array $rows
// function edit($sql, $arr = [])
// {
//     $pdo = connect_db();
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute($arr);
//     return;
// }

// delete
// @param string $sql
// @param array $arr
// @return array $rows
// function delete($sql, $arr = [])
// {
//     $pdo = connect_db();
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute($arr);
//     return;
// }


?>
