<?php
// 必要なファイルを読み込む
require_once('../classes/model/BaseModel.php');
require_once('../classes/model/Users.php');

// セッションをスタートする。
session_start();
session_regenerate_id();

//  ポストしてきたものをセッションに入れる。
$_SESSION['login'] = $_POST;

// フォームで送信されてきたトークンが正しいかどうか確認（CSRF対策）
if (!isset($_SESSION['token']) || $_SESSION['token'] !== $_POST['token']) {
    $_SESSION['err_msg']['err'] = "不正な処理が⾏われました。";
    header('Location: ./edit.php');
    exit;
}

try {
    // ユーザーIDのバリデーション
    $validityCheck = Users::isValidUser($_SESSION['login']['user'], $_SESSION['err_msg']['add']);
    if ($validityCheck === false) {
        header('Location: ./add.php');
        exit;
    }

    // 姓のバリデーション
    $validityCheck = Users::isValidFamilyName($_SESSION['login']['family_name'], $_SESSION['err_msg']['add']);
    if ($validityCheck === false) {
        header('Location: ./add.php');
        exit;
    }

    // 名のバリデーション
    $validityCheck = Users::isValidFirstName($_SESSION['login']['first_name'], $_SESSION['err_msg']['add']);
    if ($validityCheck === false) {
        header('Location: ./add.php');
        exit;
    }

    // パスワードのバリデーション
    $validityCheck = Users::isValidPassword($_SESSION['login']['password'], $_SESSION['err_msg']['add']);
    if ($validityCheck === false) {
        header('Location: ./add.php');
        exit;
    }

    // インスタンス作成
    $db = new Users();

    // 取得したレコードを連想配列として変数に代入する
    $selectUser = $db->selectUser($_POST['user']);

    // レコードの追加
    $ret = $db->addUser($_SESSION['login']['user'], $_SESSION['login']['family_name'], $_SESSION['login']['first_name'], $_SESSION['login']['password'], $_SESSION['err_msg']['add']);

    if ($ret == false) {
        // エラーメッセージをセッションに保存して、リダイレクトする
        header('Location: ./add.php');
        exit;
    }

    // 正常終了したときは、ログイン情報とエラーメッセージを削除
    unset($_SESSION['login']);
    unset($_SESSION['err_msg']);

    // login.phpへリダイレクト
    header('location: ./');
    exit;
} catch (Exception $e) {
    $_SESSION['err_msg1'] = "申し訳ございません・エラーが発生しました。";
    header('Location:../error/error.php');
    exit;
}
