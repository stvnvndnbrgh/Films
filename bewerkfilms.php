<?php
//bewerkfilms.php
require_once ("Film.php");
require_once ("FilmLijst.php");

$updated = false;
if(isset($_GET["action"]) && $_GET["action"] == "bewerk") {
    $film = new Film($_GET["id"], $_POST["titel"], $_POST["duurtijd"]);
    $filmLijst = new FilmLijst();
    //$film = $filmLijst->getFilmById($_GET['id']);
    $filmLijst->updateFilm($film);
    $updated = true;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Film bewerken</title>
    </head>
    <body>
        <h1>Film bewerken</h1>        
        <?php
        if($updated){
            print("Film bijgewerkt");
        }
        $filmLijst = new FilmLijst();
        $film = $filmLijst->getFilmById($_GET["id"]);
        ?>
        <form action="bewerkfilms.php?action=bewerk&id=<?php print($_GET["id"]); ?>" method ="post">
            Titel: <input type="text" name="titel" value="<?php print($film->getTitel()); ?>" />
            <br />
            <br />
            Duurtijd: <input type="text" name="duurtijd" value="<?php print($film->getDuurtijd());?>" />
            <br />
            <input type="submit" value="Opslaan" />
        </form>
        <br />
        <a href="films.php">Terug naar het overzicht</a>
    </body>
</html>
