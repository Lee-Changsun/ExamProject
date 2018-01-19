<?php
/**
 * Created by PhpStorm.
 * User: 이창선
 * Date: 2018-01-18
 * Time: 오후 6:40
 */

header('Content-Type: application/json');
require_once __DIR__ . "/autoload.php";

Initialization::init();

// 요청 값
$requestData = stripslashes(file_get_contents("php://input"));

$requestData = json_decode($requestData, TRUE);

$controller = new Controller();

$responseData = $controller->run($requestData);

// 응답 값 전달
echo json_encode($responseData);