<html>
    <?php
    require_once("../controller/connexion.php");
    $idIngred=$_POST['IdIngred'];
    $NomIngred=$_POST['NomIngred'];
    $frais=$_POST['frais'];
    $unite=$_POST['unite'];
    $StockMin=$_POST['StockMin'];
    $StockReel=$_POST['StockReel'];
    $PrixUHT=$_POST['PrixUHT_Moyen'];
    $Q_A_Com=$_POST['Q_A_Com'];
    $DateArchiv=$_POST['DateArchiv'];

    // ------------------------ AJOUT INGREDIENT ------------------------------
    if (isset($_POST['ajout'])){ //condition pour vérifié que les champs sont remplis
        if (empty($idIngred) || empty($NomIngred) || empty($StockMin) ||
        empty($StockReel) || empty($PrixUHT) || empty($Q_A_Com) || empty($DateArchiv) || empty($unite)){
            echo "<p style='color:red'>veuillez compléter svp.</p>";
        }
        else{
            echo "pas vide";
            // TESTE echo " ".$idIngred." ".$NomIngred." ".$frais." ".$unite." ".$StockMin." ".$StockReel." ".$PrixUHT." ".$Q_A_Com." ".$DateArchiv;
            try{
                $req = "INSERT INTO INGREDIENT (IdIngred, NomIngred, Frais, Unite, StockMin,StockReel, PrixUHT_Moyen, Q_A_Com, DateArchiv) 
                VALUES ("."'".$idIngred."','".$NomIngred."','".$frais."','".$unite."','".$StockMin."','".$StockReel."','".$PrixUHT."','".$Q_A_Com."','".$DateArchiv."')";
                $requete=$pdo->exec($req);
                echo " ingredient ajouté";
            }catch(PDOException $e){
                print $e->getMessage();
            }
        }
    };
    ?>
</html>