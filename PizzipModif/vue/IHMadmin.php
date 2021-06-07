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
            <h1>Modification </h1>    
            <table class="table table-bordered ", style="margin-top:15px;">
                <thead class="thead-dark">
                    <tr><th class="col-md-1">Nom Ingredient</th><th class="col-md-4">Option</th><th class="col-md-2">actions</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tomate</td>
                        <td>   
                            <div class="form-check">
                                <span>est frais : </span><span id="estfraiss"> dije </span>
                                <input type="checkbox" checked data-toggle="toggle">
                            </div>

                            <div class="form-check">
                                <span>Unité : </span><span id="Unite"></span>
                                <select class="pull-right" name="unite" id="unite">
                                    <option value="kg">kilogramme</option>
                                    <option value="litre">Litre</opt>
                                </select>
                            </div>
                            <div class="form-check">
                                <span>Stock min : </span>
                                <input class="pull-right" type="text" min="0">
                            </div>
                            <div class="form-check">
                                <span>Stock Réel :</span>
                                <input class="pull-right" type="text" required name="price" min="0">
                            </div>
                            <div class="form-check">
                                <span>PUHT : </span>
                                <input class="pull-right" type="text" required name="price" min="0">
                            </div>
                            <div class="form-check">
                                <span>Quantité à commander : </span>
                                <input class="pull-right" type="text" required name="price" min="0">
                            </div>




                        </td>
                        <td>
                            <button class=" btn btn-success">ajouter</button>
                            <button class=" btn btn-danger">supprimer</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- comment -->
        <script src=" js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../controlleur/IHMadminJS.js"></script>
    </body>
</html>