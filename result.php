<?php

session_start();

require_once(__DIR__ . '/common.php');

try {
  $id = filter_input(INPUT_GET, 'id');
  $sql = 'SELECT name, text, img_path FROM user_data WHERE id = :id';
  $arr = [];
  $arr[':id'] = $id;
  $rows_object = new SqlExecutor();
  $rows = $rows_object->select($sql, $arr);
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">
  <link href="assets/css/app.css" rel="stylesheet" />
  <title>結果</title>
</head>
<body class="result">
  <section>
    <div class="title_wrapper">
      <h1>理想のお相手診断テスト</h1>
    </div>
    <div class="result_wrapper">
      <div class="result_item title">
        <p>
          理想の相手の名前は<br><?= h($row['name']); ?>さん
        </p>
      </div>
      <?php if ($row['img_path']) : ?>
        <div class="result_item">
          <img src="<?= h($row['img_path']); ?>">
        </div>
      <?php endif; ?>
      <div class="result_item">
        <?= h($row['text']); ?>
      </div>
    </div>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="assets/js/main.js" type="text/javascript"></script>
</body>
</html>



