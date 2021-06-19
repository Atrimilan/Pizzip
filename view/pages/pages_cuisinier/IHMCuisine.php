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
        <link rel="stylesheet" href="../../../model/style/css/bootstrap.css">
        <link rel="stylesheet" href="../../../model/style/style_cuisinier.css">
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
                        <a class="nav-link" href="../Page_login.php">retour</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <h1>INTERFACE CUISINIER </h1>
            <button class=" btn btn-primary btn-lg mb-2" id="debut">debut</button>
            <button class="btn btn-primary btn-lg mb-2" id="fin">fin</button>            
                <table class="table table-bordered ", style="margin-top:15px;">
                    <thead class="thead-dark">
                        <tr><th class="col-md-4">Commande</th><th class="col-md-2">etat de la Commande</th></tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
           
        </div>
        <!-- comment -->
        <script src="../../../model/style/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../../model/scripts/cuisinier/IHMcuisineJS.js"></script>
    </body>
</html>>