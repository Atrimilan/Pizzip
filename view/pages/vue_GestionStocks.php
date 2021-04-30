<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
     <script src="https://code.jquery.com/jquery-latest.js"></script>
     <meta name="author" content="MUTH Kévin">
</head>
    <body>
    <div id="stage" style="background-color:#eee;">&nbsp;</div>
         <form id="civilite">
            <label for="mesures-select">Liste des fours :</label>
            <select name="mesures" id="mesures-select">
                <?php
                require_once '../PizzipProjet/view/pages/connexion.php';
                    // CONNEXION PDO
                    try {
                        $connex = new PDO('mysql:host=' . $host . ';dbname=' . $bdd, $user, $pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    } catch (PDOException $e) {
                        echo 'Erreur : ' . $e->getMessage() . '<br />';
                        echo 'N° : ' . $e->getCode();
                        die();
                    }
                    try {
                        //REQUETE
                        $requete =$connex->query("SELECT* INGREDIENT");               
                    } catch (PDOException $e) {
                        print $e->getMessage();
                    }
                    while ($ingre =$requete->fetch(PDO::FETCH_ASSOC)){ //FETCH POUR RECUPERER LES DONNEES
                        echo "<option value=".$ingre['NomIngred'].">".$ingre['Frais']." || ".$ingre['Unite'].$ingre['StockMin']
                        .$ingre['StockReel'].$ingre['PrixUHT_Moyen'].$ingre['Q_A_Com'].$ingre['DateArchiv']."</option>";
                    }
                ?>
            </select>
        </form>
    
    <div id="mesures">
        <h1 id=t_mes> Liste ingrédients </h1>
        <h1 id=t_fic> </h1>
        <ul> 

        </ul>
    </div>    
        <script type="text/javascript"> 
              $(document).ready(function(){ 
                    $("#mesures-select").change(function () {
                        $('ul').empty();
                        var selec=$('#mesures-select option:selected').val();
                        selec='fic='+selec.trim();
                        $.getJSON( "lecture.php", selec, function(mess) {
                            $.each(mess, function(key, val){
                               $('ul').append("<li> Marque : "+val["four_marque"]+" - Date : "+val["date"]+" - Heure : "+val["heure"]+
                                       " - Temperature :"+val["temperature"]+"°C </li>"); 
                            })                            
                        });
                    }); 
              });
        </script>  
    </body>
</html>