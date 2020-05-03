<?php

session_start();

require_once(__DIR__ . '/common.php');

$answer_name = filter_input(INPUT_POST, 'answer_name');

try {
  $id = filter_input(INPUT_POST, 'id');
  $sql = 'SELECT name, text, img_path FROM user_data WHERE id = :id';
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
  <title>結果画面</title>
</head>
<body>
  <h1>結果</h1>
  <p>
    <?= h($answer_name); ?>さんと相性がピッタリなのは、、、
  </p>
  <dl class="result_wrapper">
    <div class="result_item">
      <dt>
        名前
      </dt>
      <dd>
        <?= h($row['name']); ?>
      </dd>
    </div>
    <div class="result_item">
      <dt>
        写真
      </dt>
      <dd>
        <?php if ($row['img_path']) : ?>
          <img src="<?= h($row['img_path']); ?>">
        <?php endif; ?>
      </dd>
    </div>
    <div class="result_item">
      <dt>
        オススメポイント
      </dt>
      <dd>
      <?= h($row['text']); ?>
      </dd>
    </div>
  </dl>
  <a href="#" onClick="window.close();">ウィンドウを閉じる</a><br/>
</body>
</html>
