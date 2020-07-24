<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>共有レシピ帳【レシピ修正】</title>
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
        <h1>レシピ修正</h1>
        <form action="./action.php" method="POST" enctype="multipart/form-data">

            <div class="form-group border-bottom border-dark pb-3">
                <label for="image_file">画像ファイルを選択してください</label>
                <input type="file" name="image_file" id="image_file" class="form-control-file">
            </div>

            <div class="form-group border-bottom border-dark pb-3">
                <span class="input_name">調理名</span><br>
                <input type="text" name="cooking_name" class="cooking_name" data-target="form" value="カレー">
                （100文字以内）
            </div>

            <div class="form-group border-bottom border-dark pb-3">
                <span class="input_name">調理時間</span><br>
                <input type="number" min="0" name="cooking_time" class="cooking_time" data-target="form" value="15">
                分
            </div>

            <div>
                <span class="input_name">調理カテゴリ</span><br>
                <input type="checkbox" name="category" value="1" checked="checked">
                <label for="1">肉料理</label>
                <input type="checkbox" name="category" value="2">
                <label for="2">魚料理</label>
                <input type="checkbox" name="category" value="3">
                <label for="3">野菜料理</label>
                <input type="checkbox" name="category" value="4" checked="checked">
                <label for="4">ご飯もの</label>
                <input type="checkbox" name="category" value="5">
                <label for="5">和食</label>
                <input type="checkbox" name="category" value="6">
                <label for="6">中華</label>
            </div>
            <div class="form-group border-bottom border-dark pb-3">
                <input type="checkbox" name="category" value="1">
                <label for="1">肉料理</label>
                <input type="checkbox" name="category" value="2">
                <label for="2">魚料理</label>
                <input type="checkbox" name="category" value="3">
                <label for="3">野菜料理</label>
                <input type="checkbox" name="category" value="4">
                <label for="4">ご飯もの</label>
                <input type="checkbox" name="category" value="5">
                <label for="5">和食</label>
                <input type="checkbox" name="category" value="6">
                <label for="6">中華</label>
            </div>

            <div class="form-group border-bottom border-dark pb-3">
                <span class="input_name">材料・調味料</span><br>
                <textarea name="material" id="material" cols="50" rows="10">
【材料】



【調味料】
                </textarea>
            </div>
            <div class="form-group border-bottom border-dark pb-3">
                <span class="input_name">調理方法</span><br>
                <textarea name="cooking_method" id="cooking_method" cols="50" rows="10">
1.

2.

3.

4.
                </textarea>
            </div>
            <div class="form-group border-bottom border-dark pb-3">
                <span class="input_name">ポイント事項</span><br>
                <textarea name="memo" id="memo" cols="50" rows="4">

                </textarea>
            </div>
    </div>
    <input type="submit" value="送信" class="btn btn-primary">
    <input type="button" value="キャンセル" class="btn btn-outline-primary" onclick="location.href='./';">
    </form>
    </div>
    <!-- コンテナ ここまで -->

    <!-- 必要なJavascriptを読み込む -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>