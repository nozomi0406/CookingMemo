<?php
// セッションをスタートする。
session_start();
// セッションIDをリクエストのたびに更新する。
session_regenerate_id();

// セッションに保存されているユーザーの情報を削除します。
unset($_SESSION['user']);

// index.phpへリダイレクトする。
header('location: ./');
exit;
