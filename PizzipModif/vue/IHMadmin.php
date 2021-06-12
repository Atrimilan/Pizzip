<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Admin</title>
        <meta charset="UTF-8">
        <meta name="IHMcuisine" content="IHMcuisine">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">

    </head>
    <body>
        <div class="container">
            <h1>IHM Administration</h1><br>
            
            <h2>Ajout d'ingrédients</h2>
            <input type="text" id="ajouterIngChamp">
            <button class=" btn btn-primary btn-lg mb-2" id="bouttonAjouter">Ajouter</button> 
            <p id ="resultatAjout"></p>
            <h2>Modification d'ingrédients</h2>    
            <button class=" btn btn-primary btn-lg mb-2" id="bouttonUtiliser">Utiliser</button>
            <button class=" btn btn-primary btn-lg mb-2" id="bouttonArchiver">Archiver</button>           
            <table class="table table-bordered ", style="margin-top:15px;">
                <thead class="thead-dark">
                    <tr><th class="col-md-1">Nom Ingredient</th><th class="col-md-3">propriétés actuelle</th><th class="col-md-3">propriétés à modifier</th><th class="col-md-2">actions</th></tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- comment -->
        <script src=" js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../controlleur/IHMadminJS.js"></script>
    </body>
</html>
