<?php

// 設定ファイルの読み込み
require_once("config.php");
require_once("functions.php");

$id = $_GET['id'];

// DBに接続
$dbh = connectDb();

$sql = 'select * from posts where id = :id';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

$post = $stmt->fetch(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$title = $_POST['title'];
	$body = $_POST['body'];

	// エラーチェック用の配列
	$errors = array();

	if ($title == "") {
		$errors['title'] = 'タイトルを入力してください';
	}

	if ($body == "") {
		$errors['body'] = '内容を入力してください';
	}

	if (empty($errors)) {
		// DBに接続
		$dbh = connectDb();
		$sql = 'update posts set title = :title, body = :body where id = :id';
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':body', $body);
		$stmt->bindParam(':id', $id);
		$stmt->execute();

		header('Location: index.php');
	    exit;
	}

}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ブログ</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<h1>ブログアプリ</h1>

	<h2>編集</h2>
	<form action="" method="POST">
		<div>
			<p>タイトル<span class="caution">※</span></p>
			<input type="text" name="title" value="<?php echo h($post['title']); ?>">
		</div>
		<div>
			<p>本文<span class="caution">※</span></p>
			<textarea name="body"><?php echo h($post['body']); ?></textarea>
		</div>
		<input type="submit" value="投稿する">
		<p class="caution"><?php echo h($errors['title']); ?> <?php echo h($errors['body']); ?></p>
	</form>

	<a href="/index.php"><< 戻る</a>

</body>
</html>