<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>共有レシピ帳【レシピ詳細】</title>
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
            <form class="form-inline my-2 my-lg-0" action="./search_recipe.php" method="post">
                <input class="form-control mr-sm-2" type="search_recipe" placeholder="レシピ名検索" aria-label="search_recipe" name="search_recipe" value="">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">レシピ検索</button>
            </form>
            <form class="form-inline my-2 my-lg-0" action="./search_material.php" method="post">
                <input class="form-control mr-sm-2" type="search_material" placeholder="材料検索" aria-label="search_material" name="search_material" value="">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">材料検索</button>
            </form>
            <form class="form-inline my-2 my-lg-0" action="./search_time.php" method="post">
                <select class="form-control mr-sm-2" type="search_time" placeholder="レシピ名検索" aria-label="search_time" name="search_time" value="">
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
        <h1>レシピ詳細</h1>
        <div class="row my-5">
            <div class="col-md-6">
                <img src="../images/07894_l.jpg" class="card-img-top" alt="...">
                <div class="table-responsive">
                    <table class="table mt-3">
                        <tr>
                            <th class="text-nowrap">レシピ名</th>
                            <td>カレー</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap">考案者</th>
                            <td>A子</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap">登録日</th>
                            <td>2020-07-18</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap">調理時間</th>
                            <td>約20分</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap">ジャンル</th>
                            <td>ご飯もの、肉、辛いもの</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap">材料・調味料</th>
                            <td>
                                豚バラブロック 190g<br />
                                にんじん 1本<br />
                                玉ねぎ 1個<br />
                                じゃがいも 1個<br />
                                カレールー 115g<br>
                                水 830ml<br />
                                サラダ油 適量<br />
                            </td>
                        </tr>
                        <tr>
                            <th class="text-nowrap">調理方法</th>
                            <td>
                                準備.
                                野菜の皮をむいておきます。<br>
                                1.
                                肉と野菜を一口大にきります。<br>
                                2.
                                フライパンにサラダ油をひいたら中火で肉を炒めます。<br>
                                3.
                                野菜を加え、たまねぎが透き通るくらいまで炒めます。<br>
                                4.
                                水を加えて15〜20分煮込みます。<br>
                                5.
                                カレールーを加えて完全に溶かしながら10分煮込んで完成です。<br>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-nowrap">ポイント事項</th>
                            <td>
                                具材やお肉はお好みのものを使用してください。<br>
                                はちみつをいれると、味がまろやかになります。<br>
                                今回は3種類の野菜を使用しましたが、キノコ類やナスや彩り豊かなパプリカを使用しても
                                美味しく召し上がれます。お好きな食材でぜひ作ってみて下さい。<br>
                            </td>
                        </tr>
                    </table>
                </div>
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