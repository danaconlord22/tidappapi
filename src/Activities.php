<?php

declare (strict_types=1);
require_once __DIR__ . '/funktioner.php';

/**
 * Läs av rutt-information och anropa funktion baserat på angiven rutt
 * @param Route $route Rutt-information
 * @param array $postData Indata för behandling i angiven rutt
 * @return Response
 */
function activities(Route $route, array $postData): Response {
    try {
        if (count($route->getParams()) === 0 && $route->getMethod() === RequestMethod::GET) {
            return hamtaAllaAktiviteter();
        }
        if (count($route->getParams()) === 1 && $route->getMethod() === RequestMethod::GET) {
            return hamtaEnskildAktivitet($route->getParams()[0]);
        }
        if (isset($postData["activity"]) && count($route->getParams()) === 0 &&
                $route->getMethod() === RequestMethod::POST) {
            return sparaNyAktivitet((string) $postData["activity"]);
        }
        if (count($route->getParams()) === 1 && $route->getMethod() === RequestMethod::PUT) {
            return uppdateraAktivitet( $route->getParams()[0],  $postData["activity"]);
        }
        if (count($route->getParams()) === 1 && $route->getMethod() === RequestMethod::DELETE) {
            return raderaAktivetet($route->getParams()[0]);
        }
    } catch (Exception $exc) {
        return new Response($exc->getMessage(), 400);
    }

    return new Response("Okänt anrop", 400);
}

/**
 * Returnerar alla aktiviteter som finns i databasen
 * @return Response
 */
function hamtaAllaAktiviteter(): Response {
    //koppla mot databas
    $db=connectDb();
    //hämta alla aktiviteter
    $result = $db->query("select id, namn FROM aktiviteter");

    //skapa returnvärde
    $retur=[];
    foreach ($result as $item) {
        $post=new stdClass();
        $post->id=$item['id'];
        $post->name=$item['namn'];
        $retur[]=$post;
    }
    //skicka svar
    return new Response($retur);
}

/**
 * Returnerar en enskild aktivitet som finns i databasen
 * @param string $id Id för aktiviteten
 * @return Response
 */
function hamtaEnskildAktivitet(string $id): Response {
}

/**
 * Lagrar en ny aktivitet i databasen
 * @param string $aktivitet Aktivitet som ska sparas
 * @return Response
 */
function sparaNyAktivitet(string $aktivitet): Response {
    //kontrollera indata - rensa bort onödiga tecken
    $kontrolleraAktivitet=filter_var($aktivitet, FILTER_SANITIZE_ENCODED);

    //koppla mot databas
    $db=connectDb();
    //exkevera frågan
    $stmt=$db->prepare("INSERT INTO aktiviteter (namn) VALUES (:aktivitet)");
    $svar = $stmt->execute(['aktivitet'=> $kontrolleraAktivitet]);

    //kontrollera svaret
    if ($svar===true) {
        $retur=new stdClass();
        $retur->id=$db->lastInsertId();
        $retur->meddelande = ['spara lyckades', '1 post lades till'];
        return new response($retur);
    }else{
        $return=new stdClass();
        $retur->error=['bad request','något gick fel'];
        return new response($retur, 400);

    }

    //skapa utdata

    //returnera utdata
}

/**
 * Uppdaterar angivet id med ny text
 * @param string $id Id för posten som ska uppdateras
 * @param string $aktivitet Ny text
 * @return Response
 */
function uppdateraAktivitet(string $id, string $aktivitet): Response {
}

/**
 * Raderar en aktivitet med angivet id
 * @param string $id Id för posten som ska raderas
 * @return Response
 */
function raderaAktivetet(string $id): Response {
}
