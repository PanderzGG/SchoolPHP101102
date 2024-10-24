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
            <div class="mx-auto w-75 table-responsive">
                <table class="caption-top table table-dark table-striped table-hover">
                    <caption>Liste der Städte</caption>
                    <thead>
                        <tr>
                            <th scope="col" class="p-3 fw-bold text-center">ID</td>
                            <th scope="col" class="p-3 fw-bold text-center">Stadt</td>
                            <th scope="col" class="p-3 fw-bold text-center">Einwohnerzahl</td>
                            <th></th>
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
                            <td class="p-3 col-md-2 text-center"><a class="btn btn-secondary" onclick="confirmDelete(<?= $stadt->id ?>)" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" href="stadt_löschen.php?id=<?= $stadt->id?>" role="button">Löschen</td>
                        </tr>
                    </tbody>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <a class="btn btn-dark" href="stadt_bearbeiten.php?id=0" role="button">Hinzufügen</a>
        </div>
        
        <!-- Bootstrap Modal für die Lösch-Bestätigung -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Löschen bestätigen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Bist du sicher, dass du diesen Datensatz löschen möchtest?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                        <a href="#" class="btn btn-danger" id="confirmDeleteBtn">Löschen</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        
        <script>
            // Funktion, um das Modal mit der passenden ID zu verknüpfen
            function confirmDelete(id) {
                var deleteBtn = document.getElementById('confirmDeleteBtn');
                deleteBtn.href = 'stadt_löschen.php?id=' + id;
            }
        </script>
    </body>

</html>