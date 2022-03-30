<?php

/**
 * PHP item based filtering
 *
 * @package   PHP item based filtering
 */

require_once 'recommend.php';
require_once 'content_based.php';

$objects = [
    'The Matrix' => ['Action', 'Sci-Fi'],
    'Lord of The Rings' => ['Adventure', 'Drama', 'Fantasy'],
    'Batman' => ['Action', 'Drama', 'Crime'],
    'Fight Club' => ['Drama'],
    'Pulp Fiction' => ['Drama', 'Crime'],
    'Django' => ['Drama', 'Western'],
];

$user = ['Drama', 'Crime'];

$engine = new ContentBasedRecommend($user, $objects);

var_dump($engine->getRecommendation());