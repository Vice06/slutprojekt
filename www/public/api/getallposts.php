<?php

/**
 * Hämtar alla inlägg om användaren är inloggad
 * 
 * @return array $result Innehåller alla inlägg om användaren är inloggad, annars tom array
 */
session_start();

$response = [
    'auth' => false, //för att se om inloggad
    'posts' => [], //posts
    'error' => null //fel?
];

//Kontrollerar uid
if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
    $response['auth'] = true;

    //inkludera databasmodellen
    include('../../model/DbEgyTalk.php');
    $db = new DbEgyTalk();


    try {
        //hämta alla inlägg från databasen
        $posts = $db->getAllPosts();
        if ($posts) {
            $response['posts'] = $posts;
        } else {
            $response['error'] = 'Inga inlägg hittades';
        }
    } catch (Exception $e) {
        $response['error'] = 'Ett fel inträffade vid hämtning' . $e->getMessage();
    }
} else {
    $response['error'] = 'Användaren är inte inloggad';
}
// Behövs för session-cookies och anger att formatet är json
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
header('Content-Type: application/json');

// Gör om arrayen till en array med json-objekt
echo json_encode($response, JSON_UNESCAPED_UNICODE);

// Egen kod!
// $_SESSION['uid'] skall kontrolleras
