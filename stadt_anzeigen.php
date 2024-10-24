<?php 
    // EVA- Eingabe (Eingabe - Verarbeitung - Ausgabe)
    // ID der anzuzeigenden Stadt aus der URL lesen
    // URL-Parameter findet man im globalen assoziativen Array (Map) $_GET
    // Hier müssen wir prüfen, ob die URL wirklich die erwartete ID enthält
    // und zwar mit dem gewünschten Key 'id'
    // Wenn dieser KEy nicht gesetzt ist (keine ID in der URL), nehmen wir
    // als Platzhalter ID=0, weil wir sicher sind, dass es keine Stadt erreicht.
    // URL-Parameter sind strings, in diesem Fall muss ich die ID zu einem int konvertieren
    // Wenn der String keine Zahl darstellt, bekommen wir 0, ist php speziefisch
    
    // ? und : bedeuted wenn es eine ID ist dann nehme ID ansonsten also ist das eine "Wenn-Dann-Ansonsten" schreibweise.
    // außerdem wandeln wir in (int) um
    
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    
    // ID prüfen und Datensatz der Stadt laden
    // DB-Verbindung öffnen, man bekommt die Variable $db
    require_once 'db.php';
    // Provisorisch bauen wir die gesuchte ID ins SQL-ein
    // -> erreicht eine Variable oder eine Methode von einem Object
    $result = $db->query("select id,stadtname,einwohnerzahl from stadt where id = $id;");
    
    // Wenn diese ID in der DB vorhanden ist, bekommen wir den Datensatz als Objekt
    // Falls nicht vorhanden, bekommen wir FALSE ($id==0)
    
    $stadt = $result -> fetch_object();
    $result -> free();

    
    // Prüfung, ob man wirklich einen Datensatz bekommen hat
    
    if(!$stadt){
        // TODO darauf reagieren, dass die ID falsch war
        header ('Location: index.php');
        exit;
    }
    
    // Stadt anzeigen

?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Stadt <?= $stadt->stadtname ?></title>
    </head>
    <body class="bg-dark">
        <div class="container mt-5 rounded-1 shadow-sm p-3 bg-secondary">
            
            <div class="p-3 bg-secondary text-white">
            
                <h1 class="text-center">Stadt <?= $stadt->stadtname ?></h1>
            
            </div>
            
            <div class="mx-auto w-75 table-responsive">
                <table class="table table-dark table-striped">
                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                            <td scope="col" class="p-3 col-md-3 fw-bold text-end">Stadtname:</td>
                            <td scope="col" class="p-3 col-md-3 text-start"><?= $stadt->stadtname ?></td>
                        </tr>
                        <tr>
                            <td scope="col" class="p-3 col-md-3 fw-bold text-end">Einwohnerzahl:</td>
                            <td scope="col" class="p-3 col-md-3 text-start"><?= $stadt->einwohnerzahl ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <a class="btn btn-dark" href="index.php">Zurück</a>
        
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    </body>
</html>