$(document).ready(function () {

    //----------------------------------------------------------------
    // ------------- AFFICHAGE INGREDIENT DANS LE SELECT -------------
    //----------------------------------------------------------------

    var listeIngredientsJSON;   // JSON Ingrédients - Récupération AJAX des ingrédients

    $.getJSON("../../../controller/listeIngredient.php").done(function (result) {   // Requete AJAX - Récupérer tous les ingrédients
        listeIngredientsJSON = result;
        console.log(result);
        listeIngredientsJSON.listeIngredients.forEach(function (ingredActuel) {  // pour chaque ingrédient (base/opt), on l'ajoute en option de chaque select
            $('select[name="ajouterPizzaIng"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>"); //
        });
    });


    //----------------------------------------------------------------
    // ------------- ENVOI DES DONNEES AU FICHIER PHP ----------------
    //----------------------------------------------------------------

    $("#bouttonAjouterPizza").click(function () {
        let pizza = $('#ajouterPizzaNom').val();
        let ingr = $('select[name=ajouterPizzaIng]').val();
        let prix = $('#ajouterPizzaPrix').val();

        $.ajax({
            url: "../../../controller/ajouterDataPizza.php",
            type: "POST",
            data: {
                piz: pizza,
                ingr: ingr,
                prix: prix
            },
            datatype: "json",
            success: function (result) {
                console.log(result);
                document.location.href = "../../../view/pages/page_admin/ajout_Pizza.html";
            },
            error: function (err) {
                console.log(err);
                document.location.href = "../../../view/pages/page_admin/ajout_Pizza.html";
            }
        });
    });
});
