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
    if (!$mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
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
    $lastInsertId = new SqlExecutor();
    $lastInsertId->common($sql, $arr);

    $sql = 'SELECT * FROM user_data WHERE mail = :mail';
    $arr = [];
    $arr[':mail'] = $mail;
    $rows = new SqlExecutor();
    $rows->select($sql, $arr);
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
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <link href="assets/css/add.css" rel="stylesheet" />
  <title>新規登録</title>
</head>
<body class="signup">
  <div class="wrapper">
    <div class="content">
      <div class="container">
        <?php if (isset($errors)) : ?>
          <div class="alert col-md-12">
            <div class="alert alert-danger" role="alert">
              <?php foreach ($errors as $error) : ?>
                <p class="error"><?= h($error); ?></p>
              <?php endforeach ; ?>
            </div>
          </div>
        <?php endif; ?>
        <?php if (isset($success)) : ?>
          <div class="alert col-md-12">
            <div class="alert alert-success" role="alert">
                <p class="success"><?= h($success); ?></p>
                <a href="http://localhost/php/original_app/login.php">ログイン画面へ</a>
            </div>
          </div>
        <?php endif; ?>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">アプリ名 新規登録</h4>
                <form action="" method="post">
                  <div class="form-group">
                    <label for="name">名前</label>
                    <input type="text" name="name" class="form-control" placeholder="名前を入力してください">
                  </div>
                  <div class="form-group">
                    <label for="mail">メールアドレス</label>
                    <input type="email" class="form-control" name="mail" aria-describedby="emailHelp" placeholder="メールアドレスを入力してください">
                  </div>
                  <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" class="form-control" name="password" placeholder="パスワードを入力してください">
                  </div>
                  <div class="form-group">
                    <label for="password_conf">確認用パスワード</label>
                    <input type="password" class="form-control" name="password_conf" placeholder="確認用パスワードを入力してください">
                  </div>
                  <p>パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。</p>
                  <input type="submit" name="btn_submit" value="新規登録" class="submit btn btn-warning">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright">
            ©
            <script>
              document.write(new Date().getFullYear())
            </script> made with <i class="material-icons">favorite</i> by Creative Maverick
          </div>
        </div>
      </footer>
        <!-- <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: -503.2px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 503.2px; right: 0px; height: 399px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 171px; height: 136px;"></div></div></div> -->
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>

  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
  <script src="assets/js/main.js" type="text/javascript"></script>
</body>
</html>