<?php

function getUrl($shortUrl)
{
    //GET URL
    $bdd = new PDO("mysql:dbname=dimi2022_shorturl;host=localhost", "root", "");
    $bdd->exec("set names utf8");

    $query = "SELECT * FROM url WHERE short_url = :shorturl limit 1";

    $stmt = $bdd->prepare($query);

    $stmt->execute([
        ":shorturl" => $shortUrl
    ]);

    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    //END GET URL

    // UPDATE (INCREMENT)
    $query = "UPDATE url SET url_usage = url_usage+1 WHERE url.id = :id";

    $stmt = $bdd->prepare($query);

    $stmt->execute([
        ":id" => $res['id']
    ]);

    $stmt->fetch();
    // END INCREMENT

    return $res['long_url'];
}
