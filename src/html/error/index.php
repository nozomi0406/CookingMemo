<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>ログイン</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <span class="navbar-brand">TODOリスト</span>
    </nav>

    <div class="container">
        <div class="row my-2">
            <div class="col-sm-3"></div>
            <div class="col-sm-3">
                <h1></h1>
            </div>
            <div class="col-sm-3"></div>
        </div>

        <div class="row my-2">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <!-- エラーメッセージ -->
                <div class="row my-2">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 alert alert-danger alert-dismissble fade show">
                        <?= $_SESSION['err_msg1'] ?>
                        <form class="mt-4">
                            <input type="button" class="btn btn-danger" value="ログアウト"
                                onclick="location.href='../login/index.php';">
                        </form>

                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <!-- エラーメッセージ ここまで -->

            </div>
            <div class="col-sm-3"></div>
        </div>

    </div>