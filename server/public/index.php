<?php


// 設定ファイルの読み込み
require_once("config.php");
require_once("functions.php");

// DBに接続
$dbh = connectDb();

$sql = 'select * from posts';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ブログ</title>
</head>
<body>
	<h1>ブログアプリ</h1>

	<a href="/add.php">投稿する</a>	
	<h2>記事一覧</h2>
	<?php foreach ($posts as $post): ?>
	<ul>
		<li>
			<a href="show.php?id=<?php echo h($post['id']); ?>"><?php echo $post["title"] . '<br>' ?></a>
			<?php echo $post["body"] . '<br>' ?>		
			<?php echo '投稿日時: ' . $post["created_at"] . '<br>' ?>	
			[<a href="edit.php?id=<?php echo h($post['id']); ?>">編集</a>][<a href="#">削除</a>]
			<hr>
		</li>
	</ul>
	<?php endforeach; ?>

</body>
</html>