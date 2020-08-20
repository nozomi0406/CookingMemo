<?php
// 必要なファイルを読み込む
require_once('../classes/model/BaseModel.php');
require_once('../classes/model/Cooking.php');
require_once('../classes/model/Category.php');
require_once('../classes/model/Cooking_Category.php');

// セッションをスタートする。
session_start();
session_regenerate_id();

// フォームで送信されてきたトークンが正しいかどうか確認（CSRF対策）
if (!isset($_SESSION['token']) || $_SESSION['token'] !== $_POST['token']) {
    $_SESSION['err_msg']['err'] = "不正な処理が⾏われました。";
    header('Location: ./edit.php');
    exit;
}

// ログインしていないときは、login.phpへリダイレクト
if (empty($_SESSION['user'])) {
    header('location: ../login/');
    exit;
}

try {
    // インスタンス作成
    $cookingDB = new Cooking();
    $cookingCategoryDB = new Cooking_Category();

    // 現在日付の作成
    $datetime = new DateTime();
    $datetime->setTimezone(new DateTimeZone('Asia/Tokyo'));
    $day = $datetime->format('Y/m/d');

    $_SESSION['recipe'] = $_POST;

    if ($_FILES['image_file']['name'] == '') {
        $_FILES['image_file']['name'] = null;
    }

    $param = ['userId' => $_SESSION['user']['id'], 'photo' => $_FILES['image_file']['name'], 'cookingName' => $_SESSION['recipe']['cooking_name'], 'cookingTime' => $_SESSION['recipe']['cooking_time'], 'material' => $_SESSION['recipe']['material'], 'cookingMethod' => $_SESSION['recipe']['cooking_method'], 'memo' => $_SESSION['recipe']['memo'], 'registrationDate' => $day, 'id' => $_SESSION['recipe']['id']];

    // 取得したレコードを連想配列として変数に代入する
    $cookingDB->recipeUpdate($param);

    // 料理カテゴリを修正する。
    $cookingCategoryDB->cookingCategoryDelete($_SESSION['recipe']['id']);

    foreach ($_SESSION['recipe']['category'] as $v) {
        $cookingCategoryDB->cookingCategoryInsert($_SESSION['recipe']['id'], $v);
    }

    // 正常終了したときは、ログイン情報とエラーメッセージを削除
    unset($_SESSION['recipe']);

    // index.phpへリダイレクト
    header('location: ./');
    exit;
} catch (Exception $e) {
    $_SESSION['err_msg1'] = "申し訳ございません・エラーが発生しました。";
    header('Location:../error/error.php');
    exit;
}
