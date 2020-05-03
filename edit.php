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
    img_text_register();
  } catch (Exception $e) {
    $errors = exception_to_array($e);

    $id = $_GET['id'];
    $sql = 'SELECT * FROM user_data WHERE id = :id';
    $arr = [];
    $arr[':id'] = $id;
    $rows = select($sql, $arr);
    $row = reset($rows);
  }
}

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編集</title>
  </head>
  <body>
    <h1>編集画面</h1>
    <?php if (isset($errors)) : ?>
      <?php foreach ($errors as $error) : ?>
        <p class="error"><?= h($error); ?></p>
      <?php endforeach ; ?>
    <?php endif; ?>
    <form action="" method="post" enctype="multipart/form-data">
      <label for="name">名前</label>
      <input type="text" name="name" value="<?= h($row['name']); ?>">

      <label for="text">表示メッセージ</label>
      <textarea name="text"><?= h($row['text']); ?></textarea>
      <?php if ($row['img_path']) : ?>
        <p>
          <img src="<?= h($row['img_path']); ?>">
        </p>
      <?php endif; ?>

      <label for="img_path">画像ファイル</label>
      <input type="file" name="img_path">
      <input type="hidden" name="id" value=<?= $_GET['id']; ?>>
      <input type="submit" name="btn_submit" value="編集する">
      <a class="btn_cancel" href="http://localhost/php/original_app/index.php">戻る</a>
    </form>
</body>
</html>
