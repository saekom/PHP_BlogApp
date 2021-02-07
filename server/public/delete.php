<?php


// 設定ファイルの読み込み
require_once("config.php");
require_once("functions.php");

$id = $_GET['id'];

// DBに接続
$dbh = connectDb();

$sql = 'delete from posts where id = :id';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

header('Location: index.php');
exit;

?>