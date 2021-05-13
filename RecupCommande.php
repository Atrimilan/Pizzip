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

        $tabCom = recupNumcom($pdo);
        foreach ($tabCom as $key => $value) {
            $tabCom [$key] = RecupDetail($key, $pdo);
        }
        foreach ($tabCom as $key => $value) {
            foreach ($tabCom[$key] as $key1 => $value1) {
                $tabCom[$key][$key1] = recupPizza($key1, $pdo);
            }
        }
        var_dump($tabCom);
        createFichier($tabCom);
       
        function createFichier($tabCom) {
            foreach ($tabCom as $key => $value) {
                
                $txt = "<td>";
                $txt .= "    <p>commande dinamique</p>";
                $txt .= "</td>";
                $txt .= "<td>";
                $txt .= "<div class='form-check'>";
                $txt .= "    <input class='form-check-input' type='radio' name='$key' id='flexRadioDefault1'>";
                $txt .= "    <label class='form-check-label' for='flexRadioDefault1'>";
                $txt .= "        accepter";
                $txt .= "    </label>";
                $txt .= "</div>";
                $txt .= "<div class='form-check'>";
                $txt .= "    <input class='form-check-input' type='radio' name='$key' id='flexRadioDefault2' checked=''>";
                $txt .= "    <label class='form-check-label' for='flexRadioDefault2'>";
                $txt .= "        en cours de préparation";
                $txt .= "    </label>";
                $txt .= "</div>";
                $txt .= "<div class='form-check'>";
                $txt .= "    <input class='form-check-input' type='radio' name='$key' id='flexRadioDefault2' checked=''>";
                $txt .= "    <label class='form-check-label' for='flexRadioDefault2'>";
                $txt .= "        préte";
                $txt .= "    </label>";
                $txt .= "</div>";
                $txt .= "</td> ";
            }
            $fichier = $key . '.txt';
            $chemin = "dossierOF/" . $fichier;
            $fichier = fopen($chemin, "w");
            fwrite($fichier, $txt);
            fclose($fichier);
        }

        function recupPizza($numDetail, $pdo) {

            try {
                $tabResult = array();
                $requete = "select NomPizza from DETAIL where Num_Detail = $numDetail";
                $result = $pdo->query($requete);
                while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
                    $tabResult['nomPizza'] = $ligne['NomPizza'];
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
                    $tabResult[$ligne['NumCom']] = null;
                }
            } catch (PDOException $ex) {
                print $ex->getMessage();
            }

            return $tabResult;
        }

        function RecupDetail($numCom, $pdo) {

            try {
                $tabResult = array();
                $requete = "select Num_Detail,Quant from COM_DETAIL where NumCom = $numCom";
                $result = $pdo->query($requete);
                while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {     
                    $tabResult[$ligne['Num_Detail']] = null;
                }
            } catch (PDOException $ex) {
                print $ex->getMessage();
            }
            return $tabResult;
        }
        ?>


    </body>
</html>