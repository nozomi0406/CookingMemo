<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>共有レシピ帳【ユーザー登録】</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <span class="navbar-brand">共有レシピ帳</span>
    </nav>

    <!-- コンテナ -->
    <div class="container">
        <div class="container">
            <div class="row my-2">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 alert alert-info">
                    ユーザーを登録してください
                </div>
                <div class="col-sm-3"></div>
            </div>

            <!-- エラーメッセージ -->
            <div class="row my-2">
                <div class="col-sm-3"></div>
                <?php if (isset($_SESSION['err_msg']['entry'])) : ?>
                    <div class="col-sm-6 alert alert-danger alert-dismissble fade show">
                        <p class="warning"><?= $_SESSION['err_msg']['entry'] ?><button class="close" data-dismiss="alert">&times;</button></p>
                    <?php endif ?>
                    </div>
                    <div class="col-sm-3"></div>
            </div>
            <!-- エラーメッセージ ここまで -->

            <!-- 入力フォーム -->
            <div class="row my-2">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <form action="./entry_action.php" method="post">
                        <input type="hidden" name="token" value="<?= $token ?>">

                        <div class="form-group">
                            <label for="user">ユーザーID</label>
                            <input type="text" class="form-control" id="user" name="user" value="">
                        </div>

                        <div class="form-group">
                            <label for="family_name">姓</label>
                            <input type="text" class="form-control" id="family_name" name="family_name" value="">
                        </div>

                        <div class="form-group">
                            <label for="first_name">名</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="">
                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="password" class="form-control" id="password" name="password" value="">
                        </div>
                        <input type="submit" value="登録" class="btn btn-primary">
                        <input type="button" value="キャンセル" class="btn btn-outline-primary" onclick="location.href='./';">
                    </form>
                </div>
                <div class="col-sm-3"></div>
            </div>
            <!-- 入力フォーム ここまで -->

        </div>
    </div>
    <!-- コンテナ ここまで -->


    <!-- 必要なJavascriptを読み込む -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>