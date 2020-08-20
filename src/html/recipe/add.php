<?php
// 必要なファイルを読み込む
require_once('../classes/model/BaseModel.php');
require_once('../classes/model/Users.php');
require_once('../classes/model/Category.php');

// セッションをスタートする。
session_start();
session_regenerate_id();

// ワンタイムトークンを生成してセッションに保存します。
$token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] = $token;

try {
    // 検索キーワード
    $searchRecipe = "";
    $searchCategory = "";
    $searchTime = "";

    // クラスのインスタンスを生成する
    $categoryDB = new Category();

    // カテゴリを全件取得します。
    $categorylist = $categoryDB->categorySelectAll();
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
    <title>共有レシピ帳【レシピ登録】</title>
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

        <h1>レシピ登録</h1>
        <form action="./add_action.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="token" value="<?= $token ?>">
            <div class="form-group border-bottom border-dark pb-3">
                <span class="image_file">画像ファイルを選択してください</span>
                <input type="file" name="image_file" id="image_file" class="form-control-file">
            </div>

            <div class="form-group border-bottom border-dark pb-3">
                <span class="input_name">調理名</span><br>
                <?php if (isset($_SESSION['err_msg']['cooking_name']) && !empty($_SESSION['err_msg']['cooking_name'])) : ?>
                    <p class="alert alert-danger py-1 px-1"><?= $_SESSION['err_msg']['cooking_name'] ?></p>
                <?php endif ?>
                <input type="text" name="cooking_name" class="cooking_name" data-target="form" value="<?php if (isset($_SESSION['recipe']['cooking_name'])) echo $_SESSION['recipe']['cooking_name'] ?>">
                （50文字以内）
            </div>

            <div class="form-group border-bottom border-dark pb-3">
                <span class="input_name">調理時間</span><br>
                <?php if (isset($_SESSION['err_msg']['cooking_time']) && !empty($_SESSION['err_msg']['cooking_time'])) : ?>
                    <p class="alert alert-danger py-1 px-1"><?= $_SESSION['err_msg']['cooking_time'] ?></p>
                <?php endif ?>
                <input type="number" min="0" name="cooking_time" class="cooking_time" data-target="form" value="<?php if (isset($_SESSION['recipe']['cooking_time'])) echo $_SESSION['recipe']['cooking_time'] ?>">
                分
            </div>

            <span class="input_name">調理カテゴリ</span><br>
            <div class="form-group border-bottom border-dark pb-3">
                <?php if (isset($_SESSION['err_msg']['category']) && !empty($_SESSION['err_msg']['category'])) : ?>
                    <p class="alert alert-danger py-1 px-1"><?= $_SESSION['err_msg']['category'] ?></p>
                <?php endif ?>
                <?php foreach ($categorylist as $v) : ?>
                    <input type="checkbox" name="category[]" class="category" value="<?= $v['id'] ?>" <?php if (isset($_SESSION['recipe']['category']) && in_array($v['id'], $_SESSION['recipe']['category'])) echo " checked" ?>>

                    <label for="<?= $v['id'] ?>"><?= $v['category'] ?> </label>
                <?php endforeach ?>
            </div>

            <div class="form-group border-bottom border-dark pb-3">
                <span class="input_name">材料・調味料</span><br>
                <?php if (isset($_SESSION['err_msg']['material']) && !empty($_SESSION['err_msg']['material'])) : ?>
                    <p class="alert alert-danger py-1 px-1"><?= $_SESSION['err_msg']['material'] ?></p>
                <?php endif ?>
                <textarea name="material" id="material" cols="50" rows="10"><?php if (isset($_SESSION['recipe']['material'])) echo $_SESSION['recipe']['material'];
                                                                            else echo '【材料・調味料】'; ?></textarea>
            </div>
            <div class="form-group border-bottom border-dark pb-3">
                <span class="input_name">調理方法</span><br>
                <?php if (isset($_SESSION['err_msg']['cooking_method']) && !empty($_SESSION['err_msg']['cooking_method'])) : ?>
                    <p class="alert alert-danger py-1 px-1"><?= $_SESSION['err_msg']['cooking_method'] ?></p>
                <?php endif ?>
                <textarea name="cooking_method" id="cooking_method" cols="50" rows="10"><?php if (isset($_SESSION['recipe']['cooking_method'])) echo $_SESSION['recipe']['cooking_method'] ?></textarea>
            </div>
            <div class="form-group border-bottom border-dark pb-3">
                <span class="input_name">ポイント事項</span><br>
                <?php if (isset($_SESSION['err_msg']['memo']) && !empty($_SESSION['err_msg']['memo'])) : ?>
                    <p class="alert alert-danger py-1 px-1"><?= $_SESSION['err_msg']['memo'] ?></p>
                <?php endif ?>
                <textarea name="memo" id="memo" cols="50" rows="4"><?php if (isset($_SESSION['recipe']['memo'])) echo $_SESSION['recipe']['memo'] ?></textarea>
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

<!-- <br /><b>Notice</b>:  Undefined variable: searchRecipe in <b>C:\xampp\htdocs\shared_recipe_book\src\html\recipe\add.php</b> on line <b>76</b><br /> -->