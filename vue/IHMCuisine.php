<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Cuisine</title>
        <meta charset="UTF-8">
        <meta name="IHMcuisine" content="IHMcuisine">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <h1>INTERFACE CUISINIER </h1>
            <button class=" btn btn-primary btn-lg mb-2" id="debut">debut</button>
            <button class="btn btn-primary btn-lg mb-2" id="fin">fin</button> 
            <h2>nombres de commande accepter :</h2>
            <h2>nombres de commande en cours de préparation :</h2>
            <h2>nombres de commande prete : </h2>
            <h2>nombres de commande fini : </h2>
           
                <table class="table table-bordered ", style="margin-top:15px;">
                    <thead class="thead-dark">
                        <tr><th scope="col">Commande</th><th scope="col">etat de la Commande</th></tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
           
        </div>
        <!-- comment -->
        <script src=" js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../Controller/IHMcuisineJS.js"></script>
    </body>
</html>>