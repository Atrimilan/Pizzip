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
                            <div>
                                <span>est frais</span>
                                <input type="checkbox" checked data-toggle="toggle">
                            </div>

                            <div>
                                <span>Unité : </span>
                                <select name="unite" id="unite">
                                    <option value="">--choisir unite--</option>
                                    <option value="kg">kilogramme</option>
                                    <option value="litre">Litre</opt>
                                </select>
                            </div>
                            <div>
                                <p>Stock min : </p>
                                <input type="number" required name="price" min="0" value="0" >
                            </div>
                            <div>
                                <p>Stock Réel :</p>
                                <input type="number" required name="price" min="0" value="0" >
                            </div>
                            <div>
                                <p>PUHT : </p>
                                <input type="number" required name="price" min="0" value="0">
                            </div>
                            <div>
                                <p>Quantité à commander : </p>
                                <input type="number" required name="price" min="0" value="0">
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
        <script type="text/javascript" src="../Controller/IHMadminJS.js"></script>
    </body>
</html>
