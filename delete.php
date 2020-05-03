<?php

session_start();

require_once(__DIR__ . '/common.php');

if( empty($_SESSION['login_user']) || $_SESSION['login_user']['id'] !== filter_input(INPUT_GET, 'id')) {
	header('Location: http://localhost/php/original_app/signup.php');
}

if( !empty((filter_input(INPUT_GET, 'id')) && empty(filter_input(INPUT_POST, 'id')))) {
  try {
    $id = $_GET['id'];

    $sql = 'SELECT * FROM user_data WHERE id = :id';
    $arr = [];
    $arr[':id'] = $id;
    $rows = select($sql, $arr);
    $row = reset($rows);
  } catch (Exception $e) {
    $error = $e->getMessage();
  }
} elseif ( !empty(filter_input(INPUT_POST, 'id')) ) {
  try {
    $id = filter_input(INPUT_POST, 'id');
    $sql = 'DELETE FROM user_data WHERE id = :id';
    $arr = [];
    $arr[':id'] = $id;
    $rows = delete($sql, $arr);

    $url = "http://localhost/php/original_app/signup.php";
    header("Location:" . $url);
    exit();
  } catch (Exception $e) {
    $error = $e->getMessage();
  }
}

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>削除</title>
  </head>
  <body>
    <h1>削除画面</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <p>下記の名前のユーザー登録を削除しますか</p>
      <label for="name">名前</label>
      <input type="text" name="name" value="<?= h($row['name']); ?>" readonly>
      <input type="hidden" name="id" value=<?= $_GET['id']; ?>>
      <input type="submit" name="btn_submit" value="削除">
      <a class="btn_cancel" href="http://localhost/php/original_app/index.php">戻る</a>
    </form>
</body>
</html>
