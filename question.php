<?php

session_start();

require_once(__DIR__ . '/common.php');

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>質問</title>
  </head>
  <body>
    <h1>質問画面</h1>
    <form action="result.php" method="post">
      <p>
        この質問に答えるとあなたと相性ぴったりな異性のタイプが分かります！
      </p>
      <label for="answer_name">名前</label>
      <input type="text" name="answer_name">

      <p>デフォルト<br>
        <input type="radio" name="q1" value="はい"> はい
        <input type="radio" name="q1" value="いいえ"> いいえ
      </p>

      <input type="hidden" name="id" value=<?= $_GET['id']; ?>>
      <input type="submit" name="btn_submit" value="相性ぴったりな異性を判断する">
    </form>
</body>
</html>