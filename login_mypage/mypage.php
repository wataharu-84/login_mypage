<?php
mb_internal_encoding("utf8");

session_start();

if (empty($_SESSION['id'])) {

	try {
		require "DB.php";
		$db = new DB();

		//書き換え	$pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");
		$pdo = $db->connect();
	} catch(PDOException $e) {
		die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>
		しばらくしてから再度ログインをしてください。</p>
		<a href='http://localhost/login_mypage\login.php'>ログイン画面へ</a>"
		);
	}

	// prepared statementでSQL文の型を作る（DBとpostデータを照合させる。select文とwhere句を使用。）
	//書き換え	$stmt = $pdo->prepare("select * from login_mypage where mail = ? && password = ?");
	$stmt = $pdo->prepare($db->select());

	// bindValueメソッドでパラメータをセット
	$stmt->bindValue(1,$_POST['mail']);
	$stmt->bindValue(2,$_POST['password']);

	// executeでクエリを実行
	$stmt->execute();

	// データベースを切断
	$pdo = NULL;

	// fetch/while文でデータ取得し、sessionに代入
	while ($row = $stmt->fetch()) {
		$_SESSION['id'] = $row['id'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['mail'] = $row['mail'];
		$_SESSION['password'] = $row['password'];
		$_SESSION['picture'] = $row['picture'];
		$_SESSION['comments'] = $row['comments'];
	}

	// データ取得ができずに（emotyを使用して判定）sessionが無ければ、リダイレクト（エラー画面へ）
	if (empty($_SESSION['id'])) {
		header("Location:login_error.php");
	}

	if (!empty($_POST['login_keep'])) {
		$_SESSION['login_keep'] = $_POST['login_keep'];
	}
}

if (!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])) {
	setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);
	setcookie('password',$_SESSION['password'],time()+60*60*24*7);
	setcookie('login_keep',$_SESSION['login_keep'],time()+60*60*24*7);
} elseif (empty($_SESSION['login_keep'])) {
	setcookie('mail','',time()-1);
	setcookie('password','',time()-1);
	setcookie('login_keep','',time()-1);
}

?>

<!doctype html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>マイページ登録</title>
		<link rel="stylesheet" type="text/css" href="mypage.css">
	</head>

	<body>
		<header>
			<img src="4eachblog_logo.jpg">
		</header>

		<main>
			<div class="contents_frame">
				<div class="contents">
					<h2>会員情報</h2>
					<?php
						echo "<div class='info'>";
						echo "<p>こんにちは！　".$_SESSION['name']."さん</p>";
						echo "<div class='profile'>";
						echo "<img src='".$_SESSION['picture']."'>";
						echo "<div class='img_right'>";
						echo "<p>氏名：".$_SESSION['name']."</p>";
						echo "<p>メール：".$_SESSION['mail']."</p>";
						echo "<p>パスワード：".$_SESSION['password']."</p>";
						echo "</div>";
						echo "</div>";
						echo $_SESSION['comments'];
						echo "</div>";
					?>

					<div class="hensyu_button">
						<form method="post" action="mypage_hensyu.php">
							<input type="hidden" value="<?php echo rand(1,10);?>" name="form_mypage">
							<input type="submit" class="button" value="編集する">
						</form>
					</div>
				</div>
			</div>
		</main>

		<footer>
			©2018 InterNous.inc All rights reserved
		</footer>

	</body>
</html>