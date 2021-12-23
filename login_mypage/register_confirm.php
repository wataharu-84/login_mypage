<?php

mb_internal_encoding("utf8");

$temp_pic_name = $_FILES['picture']['tmp_name'];
$original_pic_name = $_FILES['picture']['name'];
$path_filename = './image/'.$original_pic_name;

move_uploaded_file($temp_pic_name,$path_filename);

?>

<!doctype html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>マイページ登録</title>
		<link rel="stylesheet" type="text/css" href="register_confirm.css">
	</head>

	<body>
		<header>
			<img src="4eachblog_logo.jpg">
		</header>

		<main>
			<div class="confirm">
				<div class="confirm_contents">
					<h2>会員登録 確認</h2>
					<p class="kakunin">こちらの内容で登録しても宜しいでしょうか？</p>
					<div class="koumoku">
						<?php
							echo "<p>氏名：".$_POST['name']."</p>";
							echo "<p>メール：".$_POST['mail']."</p>";
							echo "<p>パスワード：".$_POST['password']."</p>";
							echo "<p>プロフィール写真：".$original_pic_name."</p>";
							echo "<p>コメント：".$_POST['comments']."</p>";
						?>
					</div>

					<div class="buttons">
						<div class="button">
							<form action="register.php">
								<input type="submit" class="button1" value="戻って修正する">
							</form>
						</div>
						<div class="button">
							<form method="post" action="register_insert.php">
								<input type="submit" class="button2" value="登録する">
								<input type="hidden" value="<?php echo $_POST['name']; ?>" name="name">
								<input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail">
								<input type="hidden" value="<?php echo $_POST['password']; ?>" name="password">
								<input type="hidden" value="<?php echo $path_filename; ?>" name="picture">
								<input type="hidden" value="<?php echo $_POST['comments']; ?>" name="comments">
							</form>
						</div>
					</div>
				</div>
			</div>
		</main>

		<footer>
			©2018 InterNous.inc All rights reserved
		</footer>

	</body>