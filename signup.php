<?php

require_once(__DIR__ . '/common.php');

session_start();

$err = [];

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
  $name = filter_input(INPUT_POST, 'name');
  $mail = filter_input(INPUT_POST, 'email');
  $password = filter_input(INPUT_POST, 'password');
  $password_conf = filter_input(INPUT_POST, 'password_conf');

  // 各項目の入力チェック
  if ($name === '') {
    $err['name'] = '名前は入力必須です。';
  }

  if ($mail === '') {
    $err['mail'] = 'メールアドレスは入力必須です。';
  }

  if ($password === '') {
    $err['password'] = 'パスワードは入力必須です。';
  }

  if ($password !== $password_conf) {
    $err['password_conf'] = 'パスワードが一致しません。';
  }

  //メールアドレスのValidate
  if (!$mail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    throw new Exception('正しいメールアドレスを入力してください。');
  }

  //パスワードの正規表現
  if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  } else {
    throw new Exception('パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。');
  }

  //登録処理
  try {
    // データベースに登録
    $sql = 'INSERT INTO user_data (id, name, mail, password) VALUES (null, :name, :mail, :password)';
    $arr = [];
    $arr[':name'] = $name;
    $arr[':mail'] = $mail;
    $arr[':password'] = $password;
    $lastInsertId = insert($sql, $arr);
    $success = '登録に成功しました。';
  } catch (\Exception $e) {
    $error = $e->getMessage();
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
   <?php if (isset($error)) : ?>
     <p class="error"><?= h($error); ?></p>
   <?php endif; ?>
   <?php if (isset($success)) : ?>
     <p class="error"><?= h($success); ?></p>
   <?php endif; ?>
   <h1>ようこそ、ログインしてください。</h1>
   <form  action="login.php" method="post">
     <label for="email">メールアドレス</label>
     <input type="email" name="email">
     <label for="password">パスワード</label>
     <input type="password" name="password">
     <button type="submit">ログイン</button>
   </form>
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
     <p>※名前はニックネームでも問題ないです。</p>
     <p>※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
   </form>
 </body>
</html>
