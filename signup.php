<?php

session_start();
require_once(__DIR__ . '/common.php');

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
  $name = filter_input(INPUT_POST, 'name');
  $mail = filter_input(INPUT_POST, 'email');
  $password = filter_input(INPUT_POST, 'password');
  $password_conf = filter_input(INPUT_POST, 'password_conf');

  //登録処理
  try {
    // 各項目の入力チェック
    $e = null;

    if ($name === '') {
      $e = e('名前は入力必須です。', $e);
    }

    if ($mail === '') {
      $e = e('メールアドレスは入力必須です。', $e);
    }

    if ($password === '') {
      $e = e('パスワードは入力必須です。', $e);
    }

    if ($password !== $password_conf) {
      $e = e('パスワードが一致しません。', $e);
    }

    //メールアドレスのValidate
    if (!$mail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $e = e('正しいメールアドレスを入力してください。', $e);
    }

    //パスワードの正規表現
    if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password'])) {
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    } else {
      $e = e('パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。', $e);
    }

    if ($e) {
      throw $e;
    }

    // データベースに登録
    $sql = 'INSERT INTO user_data (id, name, mail, password) VALUES (null, :name, :mail, :password)';
    $arr = [];
    $arr[':name'] = $name;
    $arr[':mail'] = $mail;
    $arr[':password'] = $password;
    $lastInsertId = insert($sql, $arr);

    $sql = 'SELECT * FROM user_data WHERE mail = :mail';
    $arr = [];
    $arr[':mail'] = $mail;
    $rows = select($sql, $arr);
    $row = reset($rows);
    $_SESSION['login_user'] = $row;

    $success = '登録に成功しました。';

  } catch (\Exception $e) {
    $errors = exception_to_array($e);
  }
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
  <?php if (isset($errors)) : ?>
    <?php foreach ($errors as $error) : ?>
      <p class="error"><?= h($error); ?></p>
    <?php endforeach ; ?>
  <?php endif; ?>
  <?php if (isset($success)) : ?>
    <p class="error"><?= h($success); ?></p>
    <a href="http://localhost/php/original_app/index.php">ログインする</a>
  <?php endif; ?>
  <h1>初めての方はこちら</h1>
  <form action="signUp.php" method="post">
    <label for="name">名前</label>
    <input type="text" name="name">
    <label for="email">メールアドレス</label>
    <input type="email" name="email">
    <label for="password">パスワード</label>
    <input type="password" name="password">
    <label for="password_conf">確認用パスワード</label>
    <input type="password" name="password_conf">
    <button type="submit">登録</button>
    <p>※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
  </form>
</body>
</html>
