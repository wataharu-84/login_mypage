<?php
mb_internal_encoding("utf8");

session_start();

// DB接続、try catch文
try {
	require "DB.php";
	$db = new DB();

	//書き換え	$pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");
	$pdo = $db->connect();
} catch(PDOException $e) {
	die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>
	しばらくしてから再度編集をしてください。</p>
	<a href='http://localhost/login_mypage\mypage.php'>マイページ画面へ</a>"
	);
}

// prepared statementでSQL文の型を作る（update文）
//書き換え	$stmt = $pdo->prepare("update login_mypage set name = ?, mail = ?, password = ?, comments = ? where id = ?");
$stmt = $pdo->prepare($db->update());

// bindValueメソッドでパラメータをセット
$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['comments']);
$stmt->bindValue(5,$_SESSION['id']);

// executeでクエリを実行
$stmt->execute();

// prepared statementでSQL文の型を作る（select文）
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

// リダイレクト（マイページ画面へ）
header("Location:mypage.php");

?>
