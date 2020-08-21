<?php
// 必要なファイルを読み込む
require_once('../classes/model/BaseModel.php');
require_once('../classes/model/Users.php');

// セッションをスタートする。
session_start();
session_regenerate_id();

// ログインの情報をセッションに保存する
$_SESSION['login'] = $_POST;

try {

    // 3回失敗したら強制的に停止
    if ($_SESSION['err_count'] >= 3) {
        $_SESSION['err_msg1'] = "ログインできません";
        header('location: ../error/');
        exit;
    }

    // インスタンス作成
    $db = new Users();

    // Usersクラスのloginメソッドから取得したレコードを連想配列として変数に代入する
    $result = $db->login($_POST['user'], $_POST['password']);

    // 結果が無い場合、カウントしていく。
    if (empty($result)) {
        if (!isset($_SESSION['err_count'])) {
            $_SESSION['err_count'] = 1;
        } else {
            $_SESSION['err_count']++;
        }

        // メール、パスワードが一致しない時
        $_SESSION['error'] = 'ユーザー名またはパスワードが違います。';
        header('location: ./');
        exit;
    }

    // 成功したらユーザー情報をセッションに入れ、ホーム画面へ(エラーを解除しておく)
    unset($_SESSION['error']);
    $_SESSION['user'] = $result;
    header('location: ../recipe/');
    exit;
} catch (Exception $e) {
    $_SESSION['err_msg1'] = "申し訳ございません・エラーが発生しました。";
    header('Location:../error/error.php');
    exit;
}
