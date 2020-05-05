<?php

session_start();

require_once(__DIR__ . '/common.php');

if( empty($_SESSION['login_user']) || $_SESSION['login_user']['id'] !== filter_input(INPUT_GET, 'id') ) {
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
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <link href="assets/css/add.css" rel="stylesheet" />
  <title>Login</title>
</head>
<body class="dlete">
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
          アプリ名
        </a></div>
      <div class="sidebar-wrapper ps-container ps-theme-default" data-ps-id="54c5e70f-1292-ed79-06c8-ac070c19f468">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="./index.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/php/original_app/edit.php?id=<?= h($row['id']); ?>">
            <i class="material-icons">edit</i>
              <p>結果の登録または編集</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/php/original_app/result.php?id=<?= h($row['id']); ?>">
              <i class="material-icons">phone_iphone</i>
              <p>結果の確認</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/php/original_app/logout.php">
              <i class="material-icons">undo</i>
              <p>ログアウト</p>
            </a>
          </li>
          <li class="nav-item active-pro active">
            <a class="nav-link" href="http://localhost/php/original_app/delete.php?id=<?= h($row['id']); ?>">
              <i class="material-icons">delete</i>
              <p>退会</p>
            </a>
          </li>
        </ul>
      <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
    <div class="sidebar-background" style="background-image: url(../assets/img/sidebar-1.jpg) "></div></div>
    <div class="main-panel ps-container ps-theme-default ps-active-y" data-ps-id="55c276fd-4544-2436-6fe2-f3ca07d3de6b">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">退会</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
        </div>  
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container">
          <?php if (isset($error)) : ?>
            <div class="alert col-md-12">
              <div class="alert alert-success" role="alert">
                <p class="error"><?= h($error); ?></p>
              </div>
            </div>
          <?php endif; ?>
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">退会について</h4>
                  <p class="card-text">
                    このアプリを退会しますか？<br>
                    退会する場合は退会ボタンをクリックしてください。
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <form class="delete" action="" method="post">
              <div class="form-group">
                <h4>登録内容</h4>
              </div>
              <div class="form-group">
                <label for="name" class="bmd-label-floating">名前</label>
                <input type="text" name="name" value="<?= h($row['name']); ?>" class="form-control" readonly>
              </div>
              <div class="form-group">
              <input type="hidden" name="id" value=<?= $_GET['id']; ?>>
              <input type="submit" name="btn_submit" value="退会" class="btn btn-warning">
              <a class="btn_cancel btn btn-default" href="http://localhost/php/original_app/index.php">戻る</a>
              </div>
              </form>
            </div>
          </div>
        </div>
      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright float-right">
            ©
            <script>
              document.write(new Date().getFullYear())
            </script> made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
          </div>
        </div>
      </footer>
    <!-- <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: -503.2px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 503.2px; right: 0px; height: 399px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 171px; height: 136px;"></div></div></div> -->
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
