<?php

// エスケープ処理
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

// urlの変数化
$root_url = "http://localhost/php/original_app/";

// データベースに接続
// @return \PDO
function connect_db()
{
    $dsn = 'mysql:host=localhost; dbname=original_app; charset=utf8mb4';
    $username = 'root';
    $password = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    return new PDO($dsn, $username, $password, $options);
}

class SqlExecutor {

    public function common($sql, $arr = [])
    {
        $pdo = connect_db();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($arr);
        return $stmt;
    }

    public function select($sql, $arr = [])
    {
        $pdo = connect_db();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($arr);
        return $stmt->fetchAll();
    }
}

function img_text_register() {

    $id = filter_input(INPUT_POST, 'id');
    $name = filter_input(INPUT_POST, 'name');
    $text = filter_input(INPUT_POST, 'text');

    $e = null;

    if ($name === '') {
      $e = e('名前は入力必須です。', $e);
    }

    if ($text === '') {
      $e = e('表示メッセージは入力必須です。', $e);
    }

    if (is_uploaded_file($_FILES['img_path']['tmp_name'])) {

        $upfile = $_FILES['img_path'];

        if ($upfile['error'] > 0) {
            $e = e('ファイルアップロードに失敗しました。', $e);
        }

        $tmp_name = $upfile['tmp_name'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimetype = finfo_file($finfo, $tmp_name);

        $allowed_types = [
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif'
        ];

        if (!in_array($mimetype, $allowed_types)) {
            $e = e('許可されていないファイルタイプです。', $e);
        }

        $path = './uploads/';

        // 作成するディレクトリ名
        $dir_name = "user_$id";

        // 親ディレクトリが書き込み可能か、および同じ名前のディレクトリが存在しないか確認
        if( is_writable($path) && !file_exists($path.$dir_name) ) {
            mkdir($path.$dir_name);
        }

        $filename = sha1_file($tmp_name);
        $ext = array_search($mimetype, $allowed_types);
        $root = (__DIR__);
        $destination = sprintf(
            '%s/%s/%s.%s',
            'uploads',
            $dir_name,
            $filename,
            $ext
        );

        if (!move_uploaded_file($tmp_name, $destination)) {
            $e = e('ファイルの保存に失敗しました。', $e);
        }

        if ($e) {
            throw $e;
        }

        $sql = "UPDATE user_data SET name = :name, text = :text, img_path = :img_path WHERE id = :id";
        $arr = [];
        $arr[':name'] = $name;
        $arr[':text'] = $text;
        $arr[':id'] = $id;
        $arr[':img_path'] = $destination;
        $rows = new SqlExecutor();
        $rows->common($sql, $arr);

    } else {

        if ($e) {
            throw $e;
        }

        $sql = "UPDATE user_data SET name = :name, text = :text WHERE id = :id";
        $arr = [];
        $arr[':name'] = $name;
        $arr[':text'] = $text;
        $arr[':id'] = $id;
        $rows = new SqlExecutor();
        $rows->common($sql, $arr);
    }

    $url = $root_url . "user-admin.php";
    header('Location:' . $url);
    exit();
}

function e($message, $previous = null) {
    return new Exception($message, 0, $previous);
}

function exception_to_array(Exception $e) {
    do {
        $errors[] = $e->getMessage();
    } while ($e = $e->getPrevious());
    return array_reverse($errors);
}


?>
