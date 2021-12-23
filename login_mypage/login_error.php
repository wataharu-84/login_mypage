<?php
session_start();
if (isset($_SESSION['id'])) {
	header("Location:mypage.php");
}
?>

<!doctype html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>マイページ登録</title>
		<link rel="stylesheet" type="text/css" href="login.css">
	</head>

	<body>
		<header>
			<img src="4eachblog_logo.jpg">
		</header>

		<main>
			<form method="post" action="mypage.php">
				<div class=form_contents>
					<p class="error">メールアドレスまたはパスワードが間違っています。</p>
					<div class="form_koumoku">
						<label>メールアドレス</label>
						<br>
						<input type="text" class="form_box" size="40" name="mail">
					</div>
					<div class="form_koumoku">
						<label>パスワード</label>
						<br>
						<input type="password" class="form_box" size="40" name="password">
					</div>
					<div class="login_button">
						<input type="submit" class="submit_button" size="35" value="ログイン">
					</div>
				</div>
			</form>
		</main>

		<footer>
			©2018 InterNous.inc All rights reserved
		</footer>

	</body>
</html>