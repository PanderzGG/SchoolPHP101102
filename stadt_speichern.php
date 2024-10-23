<?php 
    
    // Verbindung zur DB öffnen
    require_once 'db.php';

    // Stadt ID wird übergeben um die richtige Stadt zu finden (primary key)
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    $stadtname = isset($_POST['stadtname']) ? $_POST['stadtname'] : null;
    $einwohnerzahl = isset($_POST['einwohnerzahl']) ? $_POST['einwohnerzahl'] : null;

    // Keine Daten, zurück zur index, kein Speichern.
    if($stadtname == null || empty($einwohnerzahl)){
        header('Location: index.php');
        exit;
    }

    // Mit prepare die Platzhalter für das update statement bestimmen
    $stmt = $db->prepare("UPDATE stadt SET stadtname = ?, einwohnerzahl = ? WHERE id = ?");

    // Parameter für die Platzhalter bestimmen. sii steht für string, int, int. Reihenfolge einhalten.
    $stmt->bind_param('sii', $stadtname, $einwohnerzahl, $id);

    // auf index zurückwerfen
    if($stmt->execute()){
        
        header('Location: index.php');
        
        $stmt->close();
        $db->close();
        
        exit;
    }
?>
