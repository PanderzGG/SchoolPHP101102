<?php 
    
    // Verbindung zur DB öffnen
    require_once 'db.php';

    // Stadt ID wird übergeben um die richtige Stadt zu finden (primary key)
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    // $id==0 ist OK und bedeutet "neue Stadt hinzufügen", wir werden INSERT anstatt UPDATE machen.

    $stadtname = isset($_POST['stadtname']) ? $_POST['stadtname'] : null;
    if(empty($stadtname)){
        header('Location: stadt_bearbeiten.php?id='.$id);
        exit;
    }
    
    $einwohnerzahl = isset($_POST['einwohnerzahl']) ? (int)$_POST['einwohnerzahl'] : null;
    if($einwohnerzahl <= 0){
        header('Location: stadt_bearbeiten.php?id='.$id);
        exit;
    }

    // AUFPASSEN SQL-INJECTION Beispiel, nie so:
    // $db->query("UPDATE stadt SET stadtname = '$stadtname', einwohnerzahl = '$einwohnezahl' WHERE id = '$id'")
    if($id>0){
    // Mit prepare die Platzhalter für das update statement bestimmen
    $stmt = $db->prepare("UPDATE stadt SET stadtname = ?, einwohnerzahl = ? WHERE id = ?");

    // Parameter für die Platzhalter bestimmen. sii steht für string, int, int. Reihenfolge einhalten.
    $stmt->bind_param('sii', $stadtname, $einwohnerzahl, $id);
    $stmt->execute();
    } else {
        $stmt=$db->prepare("INSERT INTO stadt (stadtname, einwohnerzahl) VALUES (?,?)");
        $stmt->bind_param('si', $stadtname, $einwohnerzahl);
        $stmt->execute();
        // Bei INSERT bekommt man die auto_increment ID
        // $id=$db->insert_id;
    }
    
    // Ein Script, dass speichert, löscht etc. darf nichts anzeigen. Hier zur location index.php weitergeleitet nach Abschluss des scripts
    header('Location: index.php');
    exit;

?>
