<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>共有レシピ帳【レシピ削除】</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

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
                    <a class="nav-link" href="./useradd.php">レシピ登録</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        テスト2 太郎 </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../login/logout.php">ログアウト</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="./recipe_search.php" method="post">
                <input class="form-control mr-sm-2" type="recipe_search" placeholder="レシピ名検索" aria-label="recipe_search" name="recipe_search" value="">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">レシピ検索</button>
            </form>
            <form class="form-inline my-2 my-lg-0" action="./material_search.php" method="post">
                <input class="form-control mr-sm-2" type="material_search" placeholder="材料検索" aria-label="material_search" name="material_search" value="">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">材料検索</button>
            </form>
            <form class="form-inline my-2 my-lg-0" action="./time_search.php" method="post">
                <select class="form-control mr-sm-2" type="search" placeholder="レシピ名検索" aria-label="Search" name="search" value="">
                    <option value="">--選択してください--</option>
                    <option value="">5分</option>
                    <option value="">10分</option>
                    <option value="">15分</option>
                    <option value="">20分</option>
                </select>
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">時間検索</button>
            </form>
        </div>
    </nav>
    <!-- ナビゲーション ここまで -->

    <!-- コンテナ -->
    <div class="container">
        <h1>レシピ削除</h1>
        <form action="./action.php" method="POST" enctype="multipart/form-data">
        こちらのレシピを削除しますか？
        </form>
    </div>
    <input type="submit" value="削除" class="btn btn-primary">
    <input type="button" value="キャンセル" class="btn btn-outline-primary" onclick="location.href='./';">
    </form>
    </div>
    <!-- コンテナ ここまで -->

    <!-- 必要なJavascriptを読み込む -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>