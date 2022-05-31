<?php

function getRandomStr($nbChar = 10): string
{
    // Generer une courte chaine max 10 char
    $char = ["a", "z", "e", "r", "t", "y", "u", "i", "o", "p", "q", "s", "d", "f", "g", "h", "j", "k", "l", "m", "w", "x", "c", "v", "b", "n", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
    $randStr = "";
    // pour chaque tour de boucle je prend un chifre aleéatoire qui correspondra à l'index dans le tableau
    for ($i = 0; $i < $nbChar; $i++) {
        $nbrand = random_int(0, count($char) - 1);
        $randStr .= $char[$nbrand];
    }
    return $randStr;
}

function generateUrl($shortUrl): string
{
    // Génère l'url avec le nom de domaine actuel
    return "http://" . $_SERVER['HTTP_HOST'] . "/?url=" . $shortUrl;
}