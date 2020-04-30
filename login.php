<?php

session_start();
require_once(__DIR__ . '/common.php');

// エラーを格納する変数
$err = [];


// 「ログイン」ボタンが押されて、POST通信のとき
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    $mail = filter_input(INPUT_POST, 'mail');
    $password = filter_input(INPUT_POST, 'password');

    if ($mail === '') {
        $err['mail'] = 'メールアドレスは入力必須です。';
    }
    if ($password === '') {
        $err['password'] = 'パスワードは入力必須です。';
    }

    // エラーがないとき
    if (count($err) === 0) {

        $sql = "SELECT * FROM user_data WHERE mail = :mail";
        $arr = [];
        $arr[':mail'] = $mail;
        $rows = select($sql, $arr);

        // パスワード検証
        foreach ($rows as $row) {
            $password_hash = $row['password'];

            // パスワード一致
            if (password_verify($password, $password_hash)) {
                session_regenerate_id(true);
                $_SESSION['login_user'] = $row;
                header('Location: http://localhost/php/original_app/index.php');
                return;
            }
        }
        $err['login'] = 'ログインに失敗しました。';
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
   <?php if (isset($err['login'])) : ?>
     <p class="error"><?= h($err['login']); ?></p>
   <?php endif; ?>
   <h1>ようこそ、ログインしてください。</h1>
   <form  action="login.php" method="post">
     <label for="mail">メールアドレス</label>
     <input type="email" name="mail">
     <label for="password">パスワード</label>
     <input type="password" name="password">
     <button type="submit">ログイン</button>
   </form>
 </body>
</html>
