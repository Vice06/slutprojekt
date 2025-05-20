<?php

/**
 * Lägger till en användare
 * 
 * @param $_POST['firstname']   förnamn
 * @param $_POST['surname']     eftrenamn
 * @param $_POST['user']        användarnamn
 * @param $_POST['pwd']         lösen
 * @return {"success": true/false} beroende på om det gick att lägga till en post
 */
session_start();

include('../../model/DbEgyTalk.php');
$db = new DbEgyTalk();
$success = false;
$data = json_decode(file_get_contents('php://input'), true);
//Hämta data från post
if (isset($data['firstname'], $data['surname'], $data['user'], $data['pwd'])) {
    $firstname = $data['firstname'];
    $surname = $data['surname'];
    $username = $data['user'];
    $password = $data['pwd'];

    //kontrollera att alla fält är ifyllda
    if ($firstname && $surname && $username && $password) {
        //Lägg till användaren i databasen
        $success = $db->addUser($firstname, $surname, $username, $password);
    }
}

$result = ['success' => $success];
header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);
