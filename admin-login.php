<?php

session_start();
require_once(__DIR__ . '/common.php');

// 「ログイン」ボタンが押されて、POST通信のとき
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
  // エラーを格納する変数
  $errors = [];

  $mail = filter_input(INPUT_POST, 'mail');
  $password = filter_input(INPUT_POST, 'password');

  if ($mail === '') {
      $errors['mail'] = 'メールアドレスは入力必須です。';
  }
  if ($password === '') {
      $errors['password'] = 'パスワードは入力必須です。';
  }

  // エラーがないとき
  if (count($errors) === 0) {

    $sql = "SELECT * FROM user_data WHERE mail = :mail";
    $arr = [];
    $arr[':mail'] = $mail;
    $rows_object = new SqlExecutor();
    $rows = $rows_object->select($sql, $arr);
    $row = reset($rows);
    $password_hash = $row['password'];
    // パスワード一致
    if (password_verify($password, $password_hash) && $row['admin_flag'] == 1) {
      session_regenerate_id(true);
      $_SESSION['login_user'] = $row;
      header('Location: http://localhost/php/original_app/admin.php');
      exit();
    }
  }
  $errors['login'] = 'ログインに失敗しました。';
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
  <title>Login</title>
</head>
<body class="admin login">
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
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">アプリ名</h4>
                <form action="admin-login.php" method="post">
                  <div class="form-group">
                    <label for="mail">メールアドレス</label>
                    <input type="email" class="form-control" name="mail" aria-describedby="emailHelp" placeholder="メールアドレスを入力してください">
                  </div>
                  <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" class="form-control" name="password" placeholder="パスワードを入力してください">
                  </div>
                  <input type="submit" name="btn_submit" value="ログイン" class="submit btn btn-warning">
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
