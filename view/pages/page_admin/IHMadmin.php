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
        <link rel="stylesheet" href="../../../model/style/css/bootstrap.css">
        <link rel="stylesheet" href="../../../model/style/style_admin.css">

    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="../Page_login.php">Administration<img src="../../../model/images/pizzipLogo.png" alt="alt"/></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="./IHMadmin.php">Ingrédients</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="./IHM_ADMIN.html">Pizza</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <h2>Ajout d'ingrédients</h2>
            <input type="text" id="ajouterIngChamp">
            <button class=" btn btn-success btn-lg mb-2" id="bouttonAjouter">Ajouter</button> 
            <p id ="resultatAjout"></p>
            <h2>Modification et archivage d'ingrédients</h2>    
            <button class=" btn btn-success btn-lg mb-2" id="bouttonUtiliser">Utiliser</button>
            <button class=" btn btn-success btn-lg mb-2" id="bouttonArchiver">Archiver</button>           
            <table class="table table-bordered ">
                <thead class="thead-dark">
                    <tr><th class="col-md-1">Nom</th><th class="col-md-5">propriétés actuelle</th><th class="col-md-5">propriétés à modifier</th><th class="col-md-2">actions</th></tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- comment -->
                <script src="../../../model/style/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../../model/scripts/admin/IHMadminJS.js"></script>
    </body>
</html>
