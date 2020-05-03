<?php

session_start();

require_once(__DIR__ . '/common.php');

try {
  $id = $_SESSION['login_user']['id'];

  $sql = 'SELECT id, name FROM user_data WHERE id = :id';
  $arr = [];
  $arr[':id'] = $id;
  $rows = select($sql, $arr);
  $row = reset($rows);
} catch (Exception $e) {

  $error = $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <?php if (isset($error)) : ?>
    <p class="error"><?= h($error); ?></p>
  <?php endif; ?>
  <h1>インデックス</h1>
  <p>ようこそ<?= h($row['name']); ?>さん</p>
  <a href="http://localhost/php/original_app/edit.php?id=<?= h($row['id']); ?>">情報を登録または編集する</a>
  <a href="http://localhost/php/original_app/delete.php?id=<?= h($row['id']); ?>">退会する</a>
  <a href="http://localhost/php/original_app/logout.php">ログアウト</a>
</body>
</html>
