<?php
$host = "remotemysql.com";
$user = "eEPfirnc1C";
$pwd = "vZFMsKIeXw";
$bdd = "eEPfirnc1C";

try {
    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $bdd, $user, $pwd);
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage() . '<br />';
    echo 'NÂ° : ' . $e->getCode();
    die();
}
?>
<html>
    <h1>IHM Gérant</h1>
    <sectiond id="ingredient">
        <h2>Ingrédient</h2>        
        <?php
            try {
                $result = $pdo->query("SELECT * FROM INGREDIENT");    // SQL par PDO

                while ($tabIngre = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<li>".$tabIngre['NomIngred']." | ".$tabIngre['Unite']." | ".$tabIngre['StockMin']." | "
                    .$tabIngre['StockReel']." | ".$tabIngre['PrixUHT_Moyen']." | ".$tabIngre['Q_A_Com']
                    ." | ".$tabIngre['DateArchiv']."</li>";
                }
                } catch (PDOException $e) {
                print $e->getMessage();
            }
        ?>
    </section>
</html>
