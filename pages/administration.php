<html>
<link rel="stylesheet" href="../model/style.css">
<meta charset="UTF-8">
<title>Piz.zip - Administration</title>
<h1>IHM Administration</h1>
<section id="ingredient">
    <h2>Ingrédient</h2>
    <?php
    require_once("../controller/connexion.php");
    try {
        $result = $pdo->query("SELECT * FROM INGREDIENT");    // SQL par PDO

        /* ------ AFFICHAGE DES INGRENDIENTS -------*/
        $i=1;
        while ($tabIngre = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<li>" . $tabIngre['NomIngred']; /*. " | Qte alerte : " . $tabIngre['StockMin'] . " | Qte réel :"
                . $tabIngre['StockReel'] . " | Prix UHT :" . $tabIngre['PrixUHT_Moyen'] . " | " . $tabIngre['Q_A_Com']
                . " | " . $tabIngre['DateArchiv'];*/
            echo " <button class='buttonIng'"." id='buttonIng".$i."'"."onclick='afficher()'> Selectionner </button> ";
            if ($tabIngre['StockReel']<=$tabIngre['StockMin']){
                echo "<b> Prévoir réapprovisionnement </b> </li>";
            }
            echo " </li>";
            $i++; // incrémentation pour de l'id boutton             
        } // (fin while)
    } // (fin try)
    catch (PDOException $e) {
        print $e->getMessage();
    }
    ?>
    <!-- ------ BOUTON AJOUTER INGREDIENT -------  -->
    <button id='ajouterIng' onclick='ajouter_ing()'> Ajouter Ingrédient </button>

</section>

</html>