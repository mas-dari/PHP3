<?php

require_once('funcs.php');
$pdo = db_conn();

//1. POSTデータ取得
$name   = $_POST['name'];
$age    = $_POST['age'];
$adress    = $_POST['adress'];
$phoneNumber  = $_POST['phoneNumber'];
$email  = $_POST['email'];
$id = $_POST['id'];

//2. DB接続します

$stmt = $pdo->prepare('UPDATE
                         gs_an_table 
                         SET
                         name = :name , age = :age , adress = :adress , phoneNumber = :phoneNumber , email = :email , indate = sysdate() 
                         where id = :id; ');


// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':age', $age, PDO::PARAM_INT); //PARAM_INTなので注意
$stmt->bindValue(':adress', $adress, PDO::PARAM_STR);
$stmt->bindValue(':phoneNumber', $phoneNumber, PDO::PARAM_INT);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    //*** function化する！*****************
    redirect('select.php');
}
