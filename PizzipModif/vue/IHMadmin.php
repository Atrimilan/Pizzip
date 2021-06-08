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

    </head>
    <body>
        <div class="container">
            <h1>IHM Administration</h1><br>
            <h2>Ajout d'ingrédients</h2>
            <input type="text" id="ajouterIngChamp">
            <button id="bouttonAjouter">Ajouter</button>
            <script type="text/javascript" src="QueryAjax.js"></script>
            <h2>Modification d'ingrédients</h2>    
            <table class="table table-bordered ", style="margin-top:15px;">
                <thead class="thead-dark">
                    <tr><th class="col-md-1">Nom Ingredient</th><th class="col-md-4">Option</th><th class="col-md-2">actions</th></tr>
                </thead>
                <tbody>
                <div>
                    <tr>
                    </tr>
                </div>
                </tbody>
            </table>
        </div>
        <!-- comment -->
        <script src=" js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../controlleur/IHMadminJS.js"></script>
    </body>
</html>
