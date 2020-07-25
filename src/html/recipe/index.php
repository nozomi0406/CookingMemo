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

        /* 打消し線を入れる */
        /* tr.del>td {
            text-decoration: line-through;
        } */

        td.del {
            text-decoration: line-through;
        }

        /* ボタンのセルは打消し線を入れない */
        tr.del>td.button {
            text-decoration: none;
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
        <div class="row my-2">
            <div class="col-md-3">
                <div class="card">
                    <img src="../images/07894_l.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">レシピ名：カレー</p>
                        <p class="card-text">考案者：A子</p>
                        <p class="card-text">調理時間：約20分</p>
                        <p class="card-text">登録日：2020-07-18</p>
                        <p class="card-text">ジャンル：ご飯もの、肉、辛いもの</p>
                        <a href="recipe.php">レシピはこちら</a>
                        <br>
                        <td class="align-middle button">
                            <form action="edit.php" method="post" class="my-sm-1">
                                <input type="hidden" name="item_id" value="2">
                                <input class="btn btn-primary my-0" type="submit" value="修正">
                            </form>
                            <form action="delete.php" method="post" class="my-sm-1">
                                <input type="hidden" name="item_id" value="2">
                                <input class="btn btn-primary my-0" type="submit" value="削除">
                            </form>
                        </td>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="../images/710189.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">レシピ名：カレー</p>
                        <p class="card-text">考案者：A子</p>
                        <p class="card-text">調理時間：約20分</p>
                        <p class="card-text">登録日：2020-07-18</p>
                        <p class="card-text">ジャンル：ご飯もの、肉、辛いもの</p>
                        <a href="recipe.php">レシピはこちら</a>
                        <br>
                        <td class="align-middle button">
                            <form action="edit.php" method="post" class="my-sm-1">
                                <input type="hidden" name="item_id" value="2">
                                <input class="btn btn-primary my-0" type="submit" value="修正">
                            </form>
                            <form action="delete.php" method="post" class="my-sm-1">
                                <input type="hidden" name="item_id" value="2">
                                <input class="btn btn-primary my-0" type="submit" value="削除">
                            </form>
                        </td>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="https://picsum.photos/300/200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">レシピ名：カレー</p>
                        <p class="card-text">考案者：A子</p>
                        <p class="card-text">調理時間：約20分</p>
                        <p class="card-text">登録日：2020-07-18</p>
                        <p class="card-text">ジャンル：ご飯もの、肉、辛いもの</p>
                        <a href="recipe.php">レシピはこちら</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="https://picsum.photos/300/200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">レシピ名：カレー</p>
                        <p class="card-text">考案者：A子</p>
                        <p class="card-text">調理時間：約20分</p>
                        <p class="card-text">登録日：2020-07-18</p>
                        <p class="card-text">ジャンル：ご飯もの、肉、辛いもの</p>
                        <a href="recipe.php">レシピはこちら</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-3">
                <div class="card">
                    <img src="https://picsum.photos/300/200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">レシピ名：カレー</p>
                        <p class="card-text">考案者：A子</p>
                        <p class="card-text">調理時間：約20分</p>
                        <p class="card-text">登録日：2020-07-18</p>
                        <p class="card-text">ジャンル：ご飯もの、肉、辛いもの</p>
                        <a href="recipe.php">レシピはこちら</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="https://picsum.photos/300/200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">レシピ名：カレー</p>
                        <p class="card-text">考案者：A子</p>
                        <p class="card-text">調理時間：約20分</p>
                        <p class="card-text">登録日：2020-07-18</p>
                        <p class="card-text">ジャンル：ご飯もの、肉、辛いもの</p>
                        <a href="recipe.php">レシピはこちら</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="https://picsum.photos/300/200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">レシピ名：カレー</p>
                        <p class="card-text">考案者：A子</p>
                        <p class="card-text">調理時間：約20分</p>
                        <p class="card-text">登録日：2020-07-18</p>
                        <p class="card-text">ジャンル：ご飯もの、肉、辛いもの</p>
                        <a href="recipe.php">レシピはこちら</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="https://picsum.photos/300/200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">レシピ名：カレー</p>
                        <p class="card-text">考案者：A子</p>
                        <p class="card-text">調理時間：約20分</p>
                        <p class="card-text">登録日：2020-07-18</p>
                        <p class="card-text">ジャンル：ご飯もの、肉、辛いもの</p>
                        <a href="recipe.php">レシピはこちら</a>
                    </div>
                </div>
            </div>
        </div>
        <a href="../login/">会員ログインはこちら</a>
    </div>
    <!-- コンテナ ここまで -->

    <!-- 必要なJavascriptを読み込む -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>