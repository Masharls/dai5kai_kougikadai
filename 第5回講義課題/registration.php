<?php
// ページ遷移しても使える変数
session_start();

    $nickname = $_POST["nickname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

// データ1件を1行にまとめる（最後に改行を入れる）
$write_data = [
    "nickname" => $nickname,
    "email" => $email,
    "password" => $password,
];
//シリアル化
$data_serialize = serialize($write_data);
// ファイルを開く．引数が`a`である部分に注目！
$file = fopen('registration_data/registration.txt', 'a');
// ファイルをロックする
flock($file, LOCK_EX);
// 指定したファイルに指定したデータを書き込む
fwrite($file, $data_serialize."\n");
// ファイルのロックを解除する
flock($file, LOCK_UN);
// // ファイルを閉じる
fclose($file);
// ページ遷移後にnicknameを反映させる
$_SESSION["nickname"] = $nickname;
// データ入力画面に移動する
header("Location:index2.php");

?>

<!-- 
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html> -->