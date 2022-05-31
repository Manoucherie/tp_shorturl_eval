<?php
session_start();

include 'tools.php';

if (isset($_POST) && isset($_POST['url'])) {
    if (filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
        $longUrl = $_POST['url'];

        $shortUrl = getRandomStr();

        try {

            $bdd = new PDO("mysql:dbname=dimi2022_shorturl;host=localhost", "root", "");
            $bdd->exec("set names utf8");



            $query = "
        INSERT INTO `url` (
            `id`, 
            `long_url`, 
            `short_url`, 
            `created_at`,
            `url_usage`
                           ) 
        VALUES (
            NULL, 
            :longurl, 
            :shorturl, 
            :datecreate,
            0
        ); ";

            $stmt = $bdd->prepare($query);
            $stmt->execute([
                ":longurl" => $longUrl,
                ":shorturl" => $shortUrl,
                ":datecreate" => date_format(date_create(), "Y/m/d H:i:s")
            ]);


            // $bdd->query($query);
            $_SESSION['short_url'] = "http://" . $_SERVER['SERVER_NAME'] . "/?url=" . $shortUrl;
            $_SESSION['msg']['status'] = "ok";
            $_SESSION['msg']['message'] = "Url Generée";

        } catch (\Throwable $th) {

            $_SESSION['msg']['status'] = "ko";
            $_SESSION['msg']['message'] = "Une erreur est survenue. " . $th->getMessage();
        } finally {
            header("location:/");
        }

        

        
    }
} else {
}
