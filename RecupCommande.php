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
        

        recupNumcom();
        RecupPizza($numCom);

        function recupNumcom() {
            try {
                $tabResult = array();
                $requete = "select NumCom from COMMANDE where Etat = 'nonTraitee'";
                $result = $pdo->query($requete);
                while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {

                    array_push($tabResult, $ligne['NumCom']);
                }
            } catch (PDOException $ex) {
                print $ex->getMessage();
            }
             var_dump($tabResult);
        }

        function RecupPizza($numCom) {
            try {
                $requete = "select NumCom from COMMANDE where Etat = 'livree'";
                $result = $pdo->query($requete);
                while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {

                    array_push($tabResult, $ligne['NumCom']);
                }
            } catch (PDOException $ex) {
                print $ex->getMessage();
            }
        }
        ?>


    </body>
</html>