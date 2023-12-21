<?php

require_once('funcs.php');
$pdo = db_conn();
//1. POSTデータ取得
$name   = $_POST['name'];
$age    = $_POST['age'];
$adress    = $_POST['adress'];
$phoneNumber  = $_POST['phoneNumber'];
$email  = $_POST['email'];

//３．データ登録SQL作成
$stmt = $pdo->prepare(
    'INSERT INTO
                        gs_an_table(
                            name, age, adress, phoneNumber, email, indate
                            )
                        VALUES (
                            :name, :age, :adress, :phoneNumber, :email, sysdate()
                            );'
);

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':age', $age, PDO::PARAM_INT); //PARAM_INTなので注意
$stmt->bindValue(':adress', $adress, PDO::PARAM_STR);
$stmt->bindValue(':phoneNumber', $phoneNumber, PDO::PARAM_INT);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    //*** function化する！*****************
    header('Location: index.php');
    exit();
}
