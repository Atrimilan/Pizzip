<?php
    header('Access-Control-Allow-Origin: *');	// CORS policy
    include("../../controller/connexion.php");  

    $detailCommande = $_POST["numcom"];
    //$livraisonCharge = $_POST["limite"];
    
        
       //            ----- REQUETE SQL -----    
        $requeteDetailCommande = "SELECT * FROM COM_DETAIL where NumCom = $detailCommande";
        
        $result1 = $pdo -> query($requeteDetailCommande);                      
        while ($tabComDetail = $result1 -> fetchAll(PDO :: FETCH_ASSOC) ) {
         
            $numDetail = $tabComDetail['Num_Detail'];
            $quantite = $tabComDetail['Quant'];      

            $tableauJsonComDetail = json_encode($tabComDetail);
            $fichierJson = file_put_contents('detailcommande.json',$tableauJsonComDetail);
            echo $tableauJsonComDetail;
        }
?>
<body>
    <script src="https://code.jquery.com/jquery-latest.js"> </script> <!-- Dernier Jquery --> 
    <script src="../../model/scripts/livraison.js"></script>  
</body>
