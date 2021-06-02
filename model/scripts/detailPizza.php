<?php
    header('Access-Control-Allow-Origin: *');	// CORS policy
    include("../../controller/connexion.php");  

    $detailPizza = $_POST["numpiz"];
    
        
       //            ----- REQUETE SQL -----    
       $requeteDetail = "SELECT * FROM DETAIL where Num_Detail = $detailPizza";

       $result = $pdo -> query($requeteDetail);

       while ($tabDetail = $result -> fetchAll(PDO :: FETCH_ASSOC) ) {
           
           $nomPizza = $tabDetail['NomPizza'];

            $tableauJsonDetail = json_encode($tabDetail);
            $fichierJson3 = file_put_contents('detailpizza.json',$tableauJsonDetail); 
            echo $tableauJsonDetail;

        }
?>
<body>
    <script src="https://code.jquery.com/jquery-latest.js"> </script> <!-- Dernier Jquery --> 
    <script src="../../model/scripts/livraison.js"></script>  
</body>
