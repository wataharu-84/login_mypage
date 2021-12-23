<?php
mb_internal_encoding("utf8");

session_start();

// mypage.phpからの導線以外は、login_error.phpにリダイレクト
if (empty($_POST['form_mypage'])) {
	header("Location:login_error.php");
}
?>

<!doctype html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>マイページ登録</title>
		<link rel="stylesheet" type="text/css" href="mypage_hensyu.css">
	</head>

	<body>
		<header>
			<img src="4eachblog_logo.jpg">
		</header>

		<main>
			<div class="hensyu">
				<div class="hensyu_contents">
					<h2>会員情報</h2>

						<form method='post' action='mypage_update.php'>
							<p>こんにちは！　<?php echo $_SESSION['name']; ?>さん</p>
							<div class='profile'>
								<img src="<?php echo $_SESSION['picture']; ?>">
								<div class='img_right'>
									<p>氏名：</p><input type='text' name='name' size='30' value="<?php echo $_SESSION['name']; ?>" required>
									<br>
									<p>メール：</p><input type='text' name='mail' size='30' value="<?php echo $_SESSION['mail']; ?>" pattern='^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$' required>
									<br>
									<p>パスワード：<input type='text' name='password' size='30' value="<?php echo $_SESSION['password']; ?>" pattern='^[a-zA-Z0-9]{6,}$' required>
								</div>
							</div>
							<textarea cols='80' rows='5' name='comments'><?php echo $_SESSION['comments']; ?></textarea>

							<div class="hensyu_button">
								<input type="submit" class="button" value="この内容に変更する">
							</div>
						</form>

				</div>
			</div>
		</main>

		<footer>
			©2018 InterNous.inc All rights reserved
		</footer>

	</body>
</html>