$(document).ready(function () {

    var listeIngredientsJSON;
    var listePizzaJSON;

    
    $.getJSON("../../../controller/admin_kevin/listePizzaUPDATE.php").done(function (result) {   // Requete AJAX - Récupérer toutes les Pizzas depuis la BDD grâce à la requête php dans le fichier
        listePizzaJSON = result;
        console.log(result);
        listePizzaJSON.listePizza.forEach(function (pizzaActuel) {  // pour chaque ingrédient (base/opt), on l'ajoute en option de chaque select
            $('select[name="selectPizza"]').append("<option value='" + pizzaActuel + "'>" + pizzaActuel + "</option>"); //
        });
    });

    $.getJSON("../../../controller/admin_kevin/listeIngredient_copy.php").done(function (result) {   // Requete AJAX - Récupérer tous les ingrédients
        listeIngredientsJSON = result;
        console.log(result);
        listeIngredientsJSON.listeIngredients.forEach(function (ingredActuel) {  // pour chaque ingrédient (base/opt), on l'ajoute en option de chaque select
            $('select[name="ingBase"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>"); //
        });
    });

    /*$("select['#ingBase']").click(function () {
        let pizza = $('#modifierPizza').val();
        let ingr = $('select[name=ajouterPizzaIng]').val();
        $.ajax({
            url: "../../../controller/../../../controller/ingredPizzaMODIFIER.php",
            type: "POST",
            data: {
                piz: pizza,
                ingr: ingr
            },
            datatype: "json",
            success: function (result) {
                console.log(result);
                document.location.href = "../../../view/pages/page_admin/modif_Pizza.html";
            },
            error: function (err) {
                console.log(err);
                document.location.href = "../../../view/pages/page_admin/modif_Pizza.html";
            }
        });
    });*/
});