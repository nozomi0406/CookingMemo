<?php
// 必要なファイルを読み込む
require_once('../classes/model/BaseModel.php');
require_once('../classes/model/Cooking.php');
require_once('../classes/model/Category.php');
require_once('../classes/model/CookingCategory.php');

// セッションをスタートする。
session_start();
session_regenerate_id();

// エラーメッセージを消去。
unset($_SESSION['err_msg']);

// ホームに戻る度にレシピ登録情報を消しておく。
unset($_SESSION['recipe']);

// ユーザー情報が無かったらlogin.phpに戻る
if (empty($_SESSION['user'])) {
    header('location: ../login/');
    exit;
}

try {
    // 検索キーワード
    $searchRecipe = "";
    $searchCategory = "";
    $searchTime = "";

    // cookingテーブルクラスのインスタンスを生成する
    $cookingDB = new Cooking();
    $categoryDB = new Category();
    $cookingCategoryDB = new CookingCategory();

    // カテゴリを全件取得します。
    $categorylist = $categoryDB->categorySelectAll();
    $recipeList = $cookingDB->getRecipeAll();

    // 検索フォーム(レシピ、材料検索の場合)
    if (isset($_GET['search_recipe'])) {
        $searchRecipe = $_GET['search_recipe'];
        $recipeList = $cookingDB->getRecipeBySearchRecipe($searchRecipe);
    }

    // 検索フォーム(カテゴリ検索の場合)
    if (isset($_GET['search_category'])) {
        $searchCategory = $_GET['search_category'];
        $recipeList = $cookingDB->getCategoryBySearchCategory($searchCategory);
    }

    // 検索フォーム(時間検索の場合)
    if (isset($_GET['search_time'])) {
        $searchTime = $_GET['search_time'];
        $recipeList = $cookingDB->getRecipeBySearchTime($searchTime);
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
    <title>共有レシピ帳【ホーム】</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <style>
        /* ボタンを横並びにする */
        form {
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
        <div class="row my-2">
            <?php foreach ($recipeList as $v) : ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="../images/<?= $v['photo'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">レシピ名：<?= $v['cooking_name'] ?></p>
                            <p class="card-text">考案者：<?= $v['family_name'] . ' ' . $v['first_name'] ?></p>
                            <p class="card-text">調理時間：<?= $v['cooking_time'] ?>分</p>
                            <p class="card-text">登録日：<?= $v['registration_date'] ?></p>

                            <?php $categoryList = $cookingCategoryDB->getCategory($v['id']); ?>
                            <p class="card-text">カテゴリ：<?php $category = '';
                                                        foreach ($categoryList as $val) {
                                                            $category .= $val['category'] . ' / ';
                                                        }
                                                        $category = rtrim($category, ' / ');
                                                        echo $category;
                                                        ?>
                            </p>
                            <td class="align-middle button">
                                <form action="recipe.php" method="get" class="my-sm-1">
                                    <input type="hidden" name="id" value="<?= $v['id'] ?>">
                                    <input class="btn btn-primary my-0" type="submit" value="レシピはこちら">
                                </form>
                                <br>
                                <?php if ($_SESSION['user']['id'] == $v['user_id']) : ?>
                                    <form action="edit.php" method="post" class="my-sm-1">
                                        <input type="hidden" name="id" value="<?= $v['id'] ?>">
                                        <input class="btn btn-primary my-0" type="submit" value="修正">
                                    </form>
                                    <form action="delete.php" method="post" class="my-sm-1">
                                        <input type="hidden" name="id" value="<?= $v['id'] ?>">
                                        <input class="btn btn-primary my-0" type="submit" value="削除">
                                    </form>
                                <?php endif ?>
                            </td>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <a href="../login/">会員ログインはこちら</a>
    </div>
    <!-- コンテナ ここまで -->

</body>

</html>