<?php
// 必要なファイルを読み込む
require_once('../classes/model/BaseModel.php');
require_once('../classes/model/Cooking.php');
require_once('../classes/model/Category.php');
require_once('../classes/model/Cooking_Category.php');

// セッションをスタートする。
session_start();
session_regenerate_id();

// ユーザー情報が無かったらlogin.phpに戻る
if (empty($_SESSION['user'])) {
    header('location: ../login/');
    exit;
}

// ワンタイムトークンを生成してセッションに保存します。
$token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] = $token;

try {
    // 検索キーワード
    $searchRecipe = "";
    $searchCategory = "";
    $searchTime = "";

    // cookingテーブルクラスのインスタンスを生成する
    $cookingDB = new Cooking();
    $categoryDB = new Category();
    $cookingCategoryDB = new Cooking_Category();

    // カテゴリを全件取得します。
    $categorylist = $categoryDB->categorySelectAll();

    // 料理を全件取得します。
    $return = false;

    if (isset($_GET['id'])) {
        $recipe = $cookingDB->getRecipePart($_GET['id']);
        // var_dump($recipe);
        // exit;

        if ($recipe == true) {
            $return = true;
        }
    }
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
    <title>共有レシピ帳【レシピ詳細】</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- <style>
        td {
            white-space: pre-wrap;
        }
    </style> -->
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
        <h1>レシピ詳細</h1>
        <div class="row my-5">
            <div class="col-md-6">
                <?php if ($return) : ?>
                    <img src="../images/<?= $recipe['photo'] ?>" class="card-img-top" alt="...">
                    <div class="table-responsive">
                        <table class="table mt-3">
                            <tr>
                                <th class="text-nowrap">レシピ名</th>
                                <td><?= $recipe['cooking_name'] ?></td>
                            </tr>
                            <tr>
                                <th class="text-nowrap">考案者</th>
                                <td><?= $recipe['family_name'] . ' ' . $recipe['first_name'] ?></td>
                            </tr>
                            <tr>
                                <th class="text-nowrap">登録日</th>
                                <td><?= $recipe['registration_date'] ?></td>
                            </tr>
                            <tr>
                                <th class="text-nowrap">調理時間</th>
                                <td><?= $recipe['cooking_time'] ?>分</td>
                            </tr>
                            <tr>
                                <?php $categoryList = $cookingCategoryDB->getCategory($recipe['id']); ?>
                                <th class="text-nowrap">カテゴリ</th>
                                <td><?php $category = '';
                                    foreach ($categoryList as $val) {
                                        $category .= $val['category'] . ' / ';
                                    }
                                    $category = rtrim($category, ' / ');
                                    echo $category;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-nowrap">材料・調味料</th>
                                <td>
                                    <?= nl2br($recipe['material']) ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-nowrap">調理方法</th>
                                <td>
                                    <?= nl2br($recipe['cooking_method']) ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-nowrap">ポイント事項</th>
                                <td>
                                    <?= nl2br($recipe['memo']) ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                <?php else : ?>
                    データはありませんよ！
                <?php endif ?>
            </div>
        </div>
    </div>

    <input type="button" value="戻る" class="btn btn-outline-primary" onclick="location.href='./';"><br>
    <a href="../login/">会員ログインはこちら</a>

    <!-- コンテナ ここまで -->

    <!-- 必要なJavascriptを読み込む -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>