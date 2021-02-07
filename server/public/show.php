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

	<h2>記事詳細画面</h2>
	<form action="" method="POST">
		<div>
			<p><?php echo h($post['title']); ?></p>
		</div>
		<div>
			<p><?php echo h($post['body']); ?></p>
		</div>
		<div>
			<?php echo '投稿日時: ' . $post["created_at"] . '<br>' ?>	
		</div>	
	</form>

	<a href="/index.php"><< 戻る</a>

</body>
</html>