<?php
    
    

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    require_once 'db.php';

    $result = $db->query("select id, stadtname, einwohnerzahl from stadt where id = $id;");

    $stadt = $result -> fetch_object();
    $result -> free();

    if(!$stadt){
        header('Location: index.php');
        exit;
    }
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
            
            <div class="mx-auto w-75">
                <form action="stadt_speichern.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                    <input type="hidden" name="id" value="<?= $stadt->id ?>" />

                    <div class="mb-3 input-group">
                        <span class="input-group-text">Stadt</span>
                        <input type="text" class="form-control" name="stadtname" value="<?= $stadt->stadtname ?>" style="width:150px;" />
                        <span class="input-group-text">Einwohnerzahl</span>
                        <input type="number" class="form-control" name="einwohnerzahl" value="<?= $stadt->einwohnerzahl ?>" style="width:150px;" />
                    </div>
                    
                    <div class="mb-3">
                        <input type="submit" class="form-control btn btn-dark" value="Absenden" />
                    </div>
                    
                    <div class="mb-3">
                        <a class="btn btn-dark" href="index.php">Zurück</a>
                    </div>
                </form>
            </div>
        </div>       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    </body>
</html>