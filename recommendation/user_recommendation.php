<?php
include 'recommend.php';
$conn = $pdo->open();
$stmtrating = $conn->prepare("SELECT * FROM ratings");
$stmtrating->execute();
$matrix=array();
foreach ($stmtrating as $rating)
{
	$stmtuser = $conn->prepare("select * from users where id=:user_id");
	$stmtuser->execute(['user_id' => $rating['user_id']]);
	$username = $stmtuser->fetch();

	$matrix[$username['firstname']][$rating['isbn']]=$rating['book_rating'];
}

if(isset($_SESSION['user'])){
	$recval=getRecommendation($matrix,$user['firstname']);
}
