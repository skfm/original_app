<?php

session_start();

require_once(__DIR__ . '/common.php');

if( empty($_SESSION['login_user']) || $_SESSION['login_user']['admin_flag'] != 1) {
	header('Location: http://localhost/php/original_app/signup.php');
}

try {

  $sql = 'SELECT id, name, mail FROM user_data';
  $arr = [];
  $rows = select($sql, $arr);
 
} catch (Exception $e) {

  $error = $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理者ページ</title>
</head>
<body>
  <?php if (isset($error)) : ?>
    <p class="error"><?= h($error); ?></p>
  <?php endif; ?>
  <h1>管理者ページ</h1>
  <?php if (isset($rows)) : ?>
    <?php foreach ($rows as $row) : ?>
      <p><?= h($row['name']); ?></p>
      <p><?= h($row['mail']); ?></p>
      <a href="http://localhost/php/original_app/admin-delete.php?id=<?= h($row['id']); ?>">削除する</a>
    <?php endforeach ; ?>
  <?php endif; ?>
  <a href="http://localhost/php/original_app/logout.php">ログアウト</a>
</body>
</html>
