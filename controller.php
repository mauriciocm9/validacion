<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Not method allowed";
    exit(0);
}

include './model.php';

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'validacion';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

$q = sprintf('INSERT INTO JUGADOR VALUES (NULL, "%s", "%s")', $_POST["juga_nomb"], $_POST["juga_apel"]);
$jugadores = $db->query($q);

$db->close();
?>