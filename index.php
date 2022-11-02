<?php 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inspiration&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Homenaje&display=swap" rel="stylesheet">
    <title>To Do List</title>
</head>

<body>
    <h1>To Do List</h1>
    <div>
        <form action="" method="get">
            <input type="text" placeholder="Entrez votre tâche" id="insérer" name="creer_tache">
            <button type="submit" id="envoyer" name="submit">Ajouter</button>
        </form>
    </div>
    <?php
    if (isset($_GET['submit']) && !empty($_GET['creer_tache'])) {
        $task = $_GET["creer_tache"]; //reset task problem
        
        $fichier_json = 'donnees.json';

        if (!file_exists($fichier_json)) {
            file_put_contents($fichier_json, '');
        }

        try {
            // On essayes de récupérer le contenu existant
            $contenu = file_get_contents($fichier_json);

            if (!$contenu || strlen($contenu) == 0) {
                // On crée le tableau JSON
                $tableau_pour_json = array();
            } else {
                // On récupère le JSON dans un tableau PHP
                $tableau_pour_json = json_decode($contenu, true);
            }
            // On ajoute le nouvel élement
            array_push($tableau_pour_json, array(
                'task' => $task,
            ));
            // On réencode en JSON
            $contenu_json = json_encode($tableau_pour_json);

            // On stocke tout le JSON
            file_put_contents($fichier_json, $contenu_json);
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
        unset($_GET["creer_tache"]);
        unset($_GET["submit"]);
    }
    $file = 'donnees.json';
    $data = file_get_contents($file);
    $objet = json_decode($data);
    $elementCount  = count($objet);
    ?> <ul>
        <?php
        foreach ($objet as $i => $item) {
            echo "<li><form action='' method='post'><button type='submit' class='btn' name='slp$i'>💔</button></form>" . $objet[$i]->task . "</li><br>";
        }
        for ($i = 0; $i < $elementCount; $i++) {
            if (isset($_GET["slp$i"])) {
                $file = 'donnees.json';
                $data = file_get_contents($file);
                $objet = json_decode($data);
                unset($objet[$i]);
            }
        }
        


        ?></ul>
        <?php

var_dump($_GET);
                    ?>
    </div>
</body>

</html>