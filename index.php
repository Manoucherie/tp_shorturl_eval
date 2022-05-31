<?php
session_start();

require_once "geturl.php";
require_once "getAllUrl.php";
require_once "tools.php";

if (isset($_GET['url'])) {
    // je recupere l'URL depuis l'url 
    $url = $_GET['url'];

    // je recupere la vrai URL depuis la BDD
    header("location:" . getUrl($url), true, "301");
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP Fim ShortUrlizer</title>
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
</head>

<body>
<div class="container">
    <h1>TP Fim ShortUrlizer</h1>

    <?php
    if (isset($_SESSION) && isset($_SESSION['msg'])) {
        if ($_SESSION['msg']['status'] == 'ok') {
            ?>

            <div class="alert alert-dismissible alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong><?= $_SESSION['msg']['message'] ?>.
            </div>

            <?php
        } else {
            ?>
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong><?= $_SESSION['msg']['message'] ?>.
            </div>
            <?php
        }
    }

    ?>

    <div class="row">
        <h2>Création d'une URL raccourcie</h2>
        <div class="col">
            <form action="addurl.php" class="border m-4" method="post">
                <label for="url" class="m-4">Url à raccourcir</label>
                <input type="url" class="form-control my-2" name="url" id="url">
                <input type="submit" class="btn btn-primary mt-2" value="Raccourcir">
            </form>
        </div>
    </div>

    <?php if (isset($_SESSION['short_url'])) { ?>
        <div class="row">
            <div class="col">
                <h2>Votre lien</h2>
                <p><?= $_SESSION['short_url'] ?></p>
            </div>
        </div>
        <?php
        session_destroy();
    } ?>

    <hr>
    <section class="row">

        <h2>Historique des URL créés par les utilisateurs de <strong>Fim ShortUrlizer</strong></h2>

        <div class="container">
            <ul class="list-group col-4 mx-auto">
                <?php
                // Boucle pour lister chaque url une par une
                foreach (getAllUrl() as &$re) {
                    ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= '<a target="_blank" href="' . generateUrl($re['short_url']) . '">' . $re['short_url'] . "</a>" ?>
                        <span class="badge bg-primary rounded-pill"><?= $re['url_usage']; ?></span>

                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>


    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
            <svg class="bi" width="30" height="24">
                <use xlink:href="#bootstrap"></use>
            </svg>
        </a>
        <span class="text-muted">&copy; 2022 FIM IT</span>
    </div>
</footer>
</body>

</html>