<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="IHMcuisine" content="IHMcuisine">
    </head>
    <body>
        <?php
        require_once './Connexion.php';
        $tabResult = array();
        try {
            $requete = "select NumCom from COMMANDE Where etat = 'Prêt à livrer'" ;
            $result = $pdo->query($requete);
            while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
                $tabResult =  $ligne['NumCom'];
            }
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        echo $tabResult 
        ?>
    </body>
</html>