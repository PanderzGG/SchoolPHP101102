<?php

require_once 'db.php';
// Man muss alles schlie0en, was man geöffnet hat
// AUSSER in PHP die Datenbankverbindung
// Hier kein $db->close();

// Liste für Datensätze vorbereiten
$staedte = array();
// SQL-Anfrage an DB schicken, mit SELECT bekommt man einen ResultSet, aus dem man die Datensätze lesen kann
$result = $db->query("select id,stadtname,einwohnerzahl from stadt order by id asc");
// Datensätze lesen
while ($stadt = $result->fetch_object()) {
    $staedte[] = $stadt;
}

$result->free();

// var_dump($staedte);
// exit;
?>

<!DOCTYPE html>
<html lang="de">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <title>Städte Tabelle</title>
    </head>

    <body class="bg-dark">
        <div class="container mt-5 rounded-1 d-flex flex-column justify-content-center align-items-center shadow-sm p-3 bg-secondary">
            <div class="text-white">
                <h1>Stadt Anzeiger</h1>
            </div>
            <div class="mx-auto w-75">
                <table class="caption-top table table-dark table-striped table-hover">
                    <caption>Liste der Städte</caption>
                    <thead>
                        <tr>
                            <th scope="col" class="p-3 fw-bold text-center">ID</td>
                            <th scope="col" class="p-3 fw-bold text-center">Stadt</td>
                            <th scope="col" class="p-3 fw-bold text-center">Einwohnerzahl</td>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($staedte as $stadt) {
                    ?>
                    <tbody>    
                        <tr>
                            <td class="p-3 col-md-2 text-center"><?= $stadt->id ?></td>
                            <td class="p-3 col-md-2 text-center"><?= $stadt->stadtname ?></td>
                            <td class="p-3 col-md-2 text-center"><?= number_format($stadt->einwohnerzahl, 0, ',', '.') ?></td>
                            <td class="p-3 col-md-2 text-center"><a class="btn btn-secondary" href="stadt_anzeigen.php?id=<?= $stadt->id ?>" role="button">Anzeigen</a>
                            <td class="p-3 col-md-2 text-center"><a class="btn btn-secondary" href="stadt_bearbeiten.php?id=<?= $stadt->id?>" role="button">Beabreiten</td>
                        </tr>
                    </tbody>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

</html>