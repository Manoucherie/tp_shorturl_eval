<?php

// GET ALL URL
function getAllUrl()
{
    $bdd = new PDO("mysql:dbname=dimi2022_shorturl;host=localhost", "root", "");
    $bdd->exec("set names utf8");

    // Sélectionne toutes les infos des url créées les 7 derniers jours dans l'ordre décroissant de la date de leur création
    $query = "SELECT * FROM url WHERE url.created_at between date_sub(now(),INTERVAL 1 WEEK) and now() ORDER BY url.created_at DESC;";

    $stmt = $bdd->prepare($query);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//END GET ALL URL