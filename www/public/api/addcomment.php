<?php
/**
 * Lägger till en kommentar
 * 
 * @param $_POST['pid']  pid för post som skall kommenteras
 * @param $_POST['comment_txt']  pid för post som skall kommenteras
 * @return {"success": true/false} beroende på om det gick att lägga till en post
 */
session_start();
include('../../model/DbEgyTalk.php');
$db = new DbEgyTalk();

$success = false;

//Kontrollerar uid
if (!isset($_SESSION['uid']) || empty($_SESSION['uid'])) {
    $result['success'] = false;
    $result['error'] = "Ingen användare inloggad";  
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
//Hämta data från post
if (isset($data['commentTxt']) && isset($data['pid'])) {
    $commentTxt = $data['commentTxt'];
    $pid = $data['pid'];
    $uid = $_SESSION['uid'];
    
    if (empty($commentTxt)) {
        $result['success'] = false;
        $result['error'] = 'inlägget är tomt.';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
    //Lägg till kommentaren i databasen
    $success = $db->addComment($uid, $pid, $commentTxt);
    if (!$success) {
        error_log("Misslyckades med att kommentera inlägg");
    }
}
// $_SESSION['uid'] skall kontrolleras
$result = ['success' => $success];

header('Content-Type: application/json');

echo json_encode($result, JSON_UNESCAPED_UNICODE);