<?php
// 必要なファイルを読み込む
require_once('../classes/model/BaseModel.php');
require_once('../classes/model/Cooking.php');
require_once('../classes/model/Category.php');
require_once('../classes/model/Cooking_Category.php');
require_once('../classes/ValidationUtil/ValidationUtil.php');

// セッションをスタートする。
session_start();
session_regenerate_id();

// ログインしていないときは、login.phpへリダイレクト
if (empty($_SESSION['user'])) {
    header('location: ../login/');
    exit;
}

// フォームで送信されてきたトークンが正しいかどうか確認（CSRF対策）
if (!isset($_SESSION['token']) || $_SESSION['token'] !== $_POST['token']) {
    $_SESSION['err_msg']['err'] = "不正な処理が⾏われました。";
    header('Location: ./add.php');
    exit;
}

// 現在日付の作成
$datetime = new DateTime();
$datetime->setTimezone(new DateTimeZone('Asia/Tokyo'));
$day = $datetime->format('Y/m/d');

// var_dump();
// exit;


// サニタイズ
foreach ($_POST as $k => $v) {
    $post[$k] = htmlspecialchars($v, ENT_QUOTES, 'utf-8');
}

try {
    //  サニタイズを行ったものをセッションする。
    $_SESSION['recipe'] = $post;
    $_SESSION['recipe']['category'] = $_POST['category'];

    // var_dump($_SESSION['recipe']['category']);
    // exit;

    // バリデーションチェック
    $validityCheck = array();

    // 調理名のバリデーション
    $validityCheck[] = ValidationUtil::isValidCookingName($_SESSION['recipe']['cooking_name'], $_SESSION['err_msg']['cooking_name']);

    // 調理時間のバリデーション
    $validityCheck[] = ValidationUtil::isValidCookingTime($_SESSION['recipe']['cooking_time'], $_SESSION['err_msg']['cooking_time']);

    // 調理カテゴリのバリデーション
    $validityCheck[] = ValidationUtil::isValidCategory($_SESSION['recipe']['category'], $_SESSION['err_msg']['category']);

    // 材料のバリデーション
    $validityCheck[] = ValidationUtil::isValidMaterial($_SESSION['recipe']['material'], $_SESSION['err_msg']['material']);

    // 調理方法のバリデーション
    $validityCheck[] = ValidationUtil::isValidCookingMethod($_SESSION['recipe']['cooking_method'], $_SESSION['err_msg']['cooking_method']);

    // ポイント事項のバリデーション
    $validityCheck[] = ValidationUtil::isValidMemo($_SESSION['recipe']['memo'], $_SESSION['err_msg']['memo']);

    // var_dump($validityCheck);
    // exit;

    // バリデーションで不備があった場合
    foreach ($validityCheck as $v) {
        // $vにnullが代入されている可能性があるので、必ず「===」で比較する

        if ($v === false) {
            header('Location: ./add.php');
            exit;
        }
    }

    // インスタンス作成
    $cookingDB = new Cooking();
    $cookingCategoryDB = new Cooking_Category();

    // 取得したレコードを連想配列として変数に代入する
    $cookingDB->recipeInsert($_SESSION['user']['id'], $_FILES['image_file']['name'], $_SESSION['recipe']['cooking_name'], $_SESSION['recipe']['cooking_time'], $_SESSION['recipe']['material'], $_SESSION['recipe']['cooking_method'], $_SESSION['recipe']['memo'], $day);

    // 追加したレコードのidを取得する。
    $lastid = $cookingDB->lastInsertId();

    // 料理レコードのidからカテゴリを追加する。
    foreach ($_SESSION['recipe']['category'] as $v) {
        $cookingCategoryDB->cookingCategoryInsert($lastid, $v);
    }

    // 正常終了したときは、ログイン情報とエラーメッセージを削除
    unset($_SESSION['recipe']);
    unset($_SESSION['err_msg']);

    // index.phpへリダイレクト
    header('location: ./');
    exit;
} catch (Exception $e) {
    $_SESSION['err_msg1'] = "申し訳ございません・エラーが発生しました。";
    header('Location:../error/error.php');
    exit;
}
