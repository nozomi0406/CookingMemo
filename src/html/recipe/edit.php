<?php
// 必要なファイルを読み込む
require_once('../classes/model/BaseModel.php');
require_once('../classes/model/Cooking.php');
require_once('../classes/model/Category.php');
require_once('../classes/model/Cooking_Category.php');

// セッションをスタートする。
session_start();
session_regenerate_id();

// ワンタイムトークンを生成してセッションに保存します。
$token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] = $token;

// ホームから修正ボタンを押していない場合、ホームに戻る
if (!isset($_POST['id'])) {
    header('Location: ./');
    exit;
}

try {

    // 検索キーワード
    $searchRecipe = "";
    $searchCategory = "";
    $searchTime = "";

    // todo_itemテーブルクラスのインスタンスを生成する
    $cookingDB = new Cooking();
    $categoryDB = new Category();
    $cookingCategoryDB = new Cooking_Category();

    // 指定した料理の情報を取得します。
    $recipe = $cookingDB->getRecipePart($_POST['id']);

    // カテゴリを全件取得します。
    $categorylist = $categoryDB->categorySelectAll();

    // 指定した料理のカテゴリを取得します。
    $recipeCategory = $cookingCategoryDB->getCategory($_POST['id']);
} catch (Exception $e) {
    $_SESSION['err_msg1'] = "申し訳ございません・エラーが発生しました。";
    header('Location:../error/error.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>共有レシピ帳【レシピ修正】</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <style>
        label {
            display: inline-block;

        }
    </style>

</head>


<body>
    <!-- ナビゲーション -->
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <span class="navbar-brand">共有レシピ帳</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./">レシピ一覧 <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./add.php">レシピ登録</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $_SESSION['user']['family_name'] . ' ' . $_SESSION['user']['first_name'] ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../login/logout.php">ログアウト</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="./" method="get">
                <input class="form-control mr-sm-2" type="search_recipe" placeholder="レシピ名、材料" aria-label="search_recipe" name="search_recipe" value="<?= $searchRecipe ?>">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">レシピ検索</button>
            </form>
            <form class="form-inline my-2 my-lg-0" action="./" method="get">
                <select class="form-control mr-sm-2" type="search_category" placeholder="カテゴリ検索" aria-label="search_category" name="search_category" value="<?= $searchCategory ?>">
                    <option value="">--選択してください--</option>
                    <?php foreach ($categorylist as $v) : ?>
                        <option value="<?= $v['id'] ?>">
                            <?= $v['category'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">カテゴリ検索</button>
            </form>
            <form class="form-inline my-2 my-lg-0" action="./" method="get">
                <select class="form-control mr-sm-2" type="search_time" placeholder="レシピ名検索" aria-label="search_time" name="search_time" value="<?= $searchTime ?>">
                    <option value="">--選択してください--</option>
                    <option value="5">5分</option>
                    <option value="10">10分</option>
                    <option value="15">15分</option>
                    <option value="20">20分</option>
                </select>
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">時間検索</button>
            </form>
        </div>
    </nav>
    <!-- ナビゲーション ここまで -->

    <!-- コンテナ -->
    <div class="container">

        <?php if (isset($_SESSION['err_msg']['err'])) : ?>
            <p class="alert alert-danger"><?= $_SESSION['err_msg']['err'] ?></p>
        <?php endif ?>

        <h1>レシピ修正 (<?= $recipe['cooking_name'] ?>)</h1>
        <form action="./edit_action.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="token" value="<?= $token ?>">
            <input type="hidden" name="id" id="id" value="<?= $_POST["id"] ?>">
            <div class="form-group border-bottom border-dark pb-3">
                <span class="image_file"></span>
                <input type="file" name="image_file" id="image_file" class="form-control-file">
            </div>

            <div class="form-group border-bottom border-dark pb-3">
                <span class="input_name">調理名</span><br>
                <input type="text" name="cooking_name" class="cooking_name" data-target="form" value="<?= $recipe['cooking_name']  ?>">
                （100文字以内）
            </div>

            <div class="form-group border-bottom border-dark pb-3">
                <span class="input_name">調理時間</span><br>
                <input type="number" min="0" name="cooking_time" class="cooking_time" data-target="form" value="<?= $recipe['cooking_time'] ?>">
                分
            </div>

            <span class="input_name">調理カテゴリ</span><br>
            <div class="form-group border-bottom border-dark pb-3">
                <?php foreach ($categorylist as $v) : ?>
                    <input type="checkbox" name="category[]" class="category" value="<?= $v['id'] ?>" <?php foreach ($recipeCategory as $val) if ($v['id'] == $val['category_id']) echo " checked" ?>>
                    <label for="<?= $v['id'] ?>"><?= $v['category'] ?> </label>
                <?php endforeach ?>
            </div>

            <div class="form-group border-bottom border-dark pb-3">
                <span class="input_name">材料・調味料</span><br>
                <textarea name="material" id="material" cols="50" rows="10"><?= $recipe['material'] ?></textarea>
            </div>
            <div class="form-group border-bottom border-dark pb-3">
                <span class="input_name">調理方法</span><br>
                <textarea name="cooking_method" id="cooking_method" cols="50" rows="10"><?= $recipe['cooking_method'] ?></textarea>
            </div>
            <div class="form-group border-bottom border-dark pb-3">
                <span class="input_name">ポイント事項</span><br>
                <textarea name="memo" id="memo" cols="50" rows="4"><?= $recipe['memo'] ?></textarea>
            </div>
    </div>
    <input type="submit" value="送信" class="btn btn-primary">
    <input type="button" value="キャンセル" class="btn btn-outline-primary" onclick="location.href='./';"><br>
    </form>
    <a href="../login/">会員ログインはこちら</a>
    </div>
    <!-- コンテナ ここまで -->

    <!-- 必要なJavascriptを読み込む -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>