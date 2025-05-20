<?php

/**
 * Lägger till en post
 * 
 * @param $_POST['post_txt']  Postade texten
 * @return {"success": true/false} beroende på om det gick att lägga till en post
 */
session_start();
include('../../model/DbEgyTalk.php');
$db = new DbEgyTalk();
$success = false;

$data = json_decode(file_get_contents('php://input'), true);
//Kontrollerar uid
if (!isset($_SESSION['uid']) || empty($_SESSION['uid'])) {
    $result['success'] = false;
    $result['error'] = "Ingen användare inloggad";
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
//Hämta data från post
if (isset($data['postTxt'])) {
    $postTxt = $data['postTxt'];
    $uid = $_SESSION['uid'];
    if (empty($postTxt)) {
        $result['success'] = false;
        $result['error'] = 'inlägget är tomt.';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
    //Lägg till användaren i databasen
    $success = $db->addPost($uid, $postTxt);
    if (!$success) {
        error_log("Misslyckades med att lägga till inlägg");
    }
}

$result = ['success' => $success];

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);
