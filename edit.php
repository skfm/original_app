<?php

session_start();

require_once(__DIR__ . '/common.php');

if( empty($_SESSION['login_user']) || $_SESSION['login_user']['id'] !== filter_input(INPUT_GET, 'id')) {
  $url = $root_url . "signup.php";
  header('Location:' . $url);
}

if( !empty((filter_input(INPUT_GET, 'id')) && empty(filter_input(INPUT_POST, 'id')))) {
  try {
    $id = $_GET['id'];

    $sql = 'SELECT * FROM user_data WHERE id = :id';
    $arr = [];
    $arr[':id'] = $id;
    $rows_object = new SqlExecutor();
    $rows = $rows_object->select($sql, $arr);
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
    $rows = new SqlExecutor();
    $rows->select($sql, $arr);
    $row = reset($rows);
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
<body class="edit">
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
          <li class="nav-item active">
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
          <li class="nav-item active-pro">
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
            <a class="navbar-brand" href="javascript:;">編集</a>
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
                  <h4 class="card-title">編集方法</h4>
                  <p class="card-text">
                    下記のフォームに相性診断の結果に表示させたい<br>
                    「名前」、「表示メッセージ」、「画像」を<br>
                    入力してください。
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <form class="edit" action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <h4>登録内容</h4>
              </div>
              <div class="form-group">
                <label for="name" class="bmd-label-floating">名前</label>
                <input type="text" name="name" value="<?= h($row['name']); ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="text">メッセージ</label>
                <textarea class="form-control" name="text" rows="5"><?= h($row['text']); ?></textarea>
              </div>
              <?php if ($row['img_path']) : ?>
              <div class="form-group">
                <label for="text">登録されている画像</label>
                <img src="<?= h($row['img_path']); ?>">
              </div>
              <?php endif; ?>
              <div class="form-group">
                <label for="img_path">画像ファイル</label>
                <input type="file" name="img_path">
              </div>
              <div class="form-group">
              <input type="hidden" name="id" value=<?= $_GET['id']; ?>>
              <input type="submit" name="btn_submit" value="編集する" class="btn btn-warning">
              <a class="btn_cancel btn btn-default" href="http://localhost/php/original_app/user-admin.php">戻る</a>
              </div>
              </form>
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
