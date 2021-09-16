<?php
    // ページ遷移しても使える変数
    session_start();
    $email = $_POST["email"];
    $password = $_POST["password"];

// ファイルを開く（読み取り専用）
$file = fopen('registration_data/registration.txt', 'r');
// ファイルをロック
flock($file, LOCK_EX);

// fgets()で1行ずつ取得→$lineに格納
if ($file) {
    while ($line = fgets($file)) {
        $data = unserialize($line);
        if($data["email"] == $email and $data["password"] == $password){
            $_SESSION["nickname"] = $data["nickname"];
        } else {
            // ロックを解除する
            flock($file, LOCK_UN);
            // ファイルを閉じる
            fclose($file);
            header("Location:membersignin.html");
            exit;
        }
    }
}
// ロックを解除する
flock($file, LOCK_UN);
// ファイルを閉じる
fclose($file);
// `$str`に全てのデータ（タグに入った状態）がまとまるので，HTML内の任意の場所に表示する．
header("Location:index2.php");

?>