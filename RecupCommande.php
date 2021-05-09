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
        
        $tabFinal =array();
        $tabCom = recupNumcom($pdo);
        foreach ($tabCom as $value) {
            array_push($tabFinal,RecupPizza($value,$pdo)) ;
        }
        var_dump($tabFinal);
        

        function recupNumcom($pdo) {
       
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
             return $tabResult;
        }

        function RecupPizza($numCom,$pdo) {
            try {
                $tabResult = array();
                $requete = "select Num_Detail,Quant from COM_DETAIL where NumCom = $numCom";
                $result = $pdo->query($requete);
                while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {

                    array_push($tabResult, $ligne['Num_Detail']);
                }
            } catch (PDOException $ex) {
                print $ex->getMessage();
            }
            return $tabResult;
        }
        ?>


    </body>
</html>