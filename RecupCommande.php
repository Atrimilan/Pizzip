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
        
        $tabNumDetail = array();
        $tabFinal = array();
        $tabCom = recupNumcom($pdo);
        foreach ($tabCom as $value) {
            array_push($tabNumDetail, RecupDetail($value,$pdo)) ;
        }
        var_dump($tabNumDetail);
        for($i = 0; $i < count($tabCom); $i++) {
            for($j = 0; $j < count($tabCom[$i]); $j++) {
                if ($tabCom[$i][$j] != null){
                     echo $numDetail =$tabCom[$i][$j];
                    var_dump(recupPizza($pdo,$numDetail )) ;
                    //array_push($tabCom[$i][$j],recupPizza($pdo,$numDetail ));
                }
               
            }
        }
        function recupPizza($pdo,$numDetail) {
            echo $numDetail;
            try {
                $tabResult = array();
                $requete = "select NomPizza from DETAIL where Num_Detail = $numDetail";
                $result = $pdo->query($requete);
                while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
                    if ($ligne != null){
                        array_push($tabResult, $ligne['NomPizza']);
                    }
                    
                }
            } catch (PDOException $ex) {
                print $ex->getMessage();
            }
             return $tabResult;
        }
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
            
             return $tabResult;
        }

        function RecupDetail($numCom,$pdo) {
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