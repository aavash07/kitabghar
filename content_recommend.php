<?php
require 'contentbased/recommend.php';
require 'contentbased/content_based.php';

$conn = $pdo->open();
$stmtbooks = $conn->prepare("SELECT * FROM books join category on books.category_id=category.id");
$stmtbooks->execute();

$objects = array();

foreach ($stmtbooks as $book){
    $objects[$book['isbn']]=[$book['name']];
}
$user_interest = array();
if (isset($_SESSION['user'])){
    $stmtInterest = $conn->prepare("SELECT * FROM interest join category on interest.category_id=category.id having user_id=:uid");
    $stmtInterest->execute(['uid'=>$user['id']]);
    foreach ($stmtInterest as $interest){
        $user_interest[] = $interest['name'];
    }
}else{
    echo "You need to be signed in";
}

$engine = new ContentBasedRecommend($user_interest, $objects);

$recommend_result=$engine->getRecommendation();