<html>
<title>Piz.zip - Administration</title>
<h1>IHM Administration</h1>
<section id="ingredient">
    <h2>Ingrédient</h2>
    <?php
    require_once("../controller/connexion.php");
    try {
        $result = $pdo->query("SELECT * FROM INGREDIENT");    // SQL par PDO

        while ($tabIngre = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<li>" . $tabIngre['NomIngred'] . " | " . $tabIngre['Unite'] . " | " . $tabIngre['StockMin'] . " | "
                . $tabIngre['StockReel'] . " | " . $tabIngre['PrixUHT_Moyen'] . " | " . $tabIngre['Q_A_Com']
                . " | " . $tabIngre['DateArchiv'];
            echo " <button>Selection</button> ";
            if ($tabIngre['StockReel']<5){
                echo "<b>A recharger</b> </li>";
            }
            echo "</li>";
        }
    } catch (PDOException $e) {
        print $e->getMessage();
    }
    ?>
</section>

</html>