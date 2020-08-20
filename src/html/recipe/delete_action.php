<?php
// 必要なファイルを読み込む
require_once('../classes/model/BaseModel.php');
require_once('../classes/model/Cooking.php');
require_once('../classes/model/Cooking_Category.php');

// セッションをスタートする。
session_start();
session_regenerate_id();

// ログインしていないときは、login.phpへリダイレクト
if (empty($_SESSION['user'])) {
    header('location: ../login/');
    exit;
}

try {

    // フォームで送信されてきたトークンが正しいかどうか確認（CSRF対策）
    if (!isset($_SESSION['token']) || $_SESSION['token'] !== $_POST['token']) {
        $_SESSION['err_msg']['err'] = "不正な処理が⾏われました。";
        header('Location: ./delete.php');
        exit;
    }

    // インスタンス作成
    $cookingDB = new Cooking();
    // $cookingCategoryDB = new Cooking_Category();

    // 取得したレコードを連想配列として変数に代入する
    $cookingDB->recipeDalete($_POST['id']);

    // var_dump($delete);
    // exit;

    // 正常終了したときは、ログイン情報とエラーメッセージを削除
    unset($_SESSION['error']);

    // login.phpへリダイレクト
    header('location: ./');
    exit;
} catch (Exception $e) {
    $_SESSION['err_msg1'] = "申し訳ございません・エラーが発生しました。";
    header('Location:../error/error.php');
    exit;
}
