$(document).ready(function () {
    //----------------------------------------------------------------
    //-- RECUPERATION DES DONNES POUR AFFICHER LA LISTE DES PIZZAS ---
    //----------------------------------------------------------------

    var listePizzaJSON;

    $.getJSON("../../../controller/admin_kevin/listePizza.php").done(function (result) {
        console.log("test 1");
        listePizzaJSON = result;
        console.log(result);
        listePizzaJSON.listePizza.forEach(function (pizzaActuel) {
            console.log(pizzaActuel);
            $('body').append('<span><button id="' + pizzaActuel + '" class="Supprimer">Supprimer</button>'+pizzaActuel+"<br></span>");
        });
    });

    //----------------------------------------------------------------
    //----- RECUPERATION l'ID POUR POURVOIR SUPPRIMER LA PIZZA -------
    //----------------------------------------------------------------
    //console.log("test 2");
    //console.log($("body").find(".Supprimer"));
    //$('body').find('.Supprimer').click(function (event) {
    $("body").on('click', "button", function () {
        console.log("teste 3 ");
        let leBouton = event.target.id;
        alert('vous avez supprimé la pizza ' + leBouton);
        $.getJSON("../../../controller/admin_kevin/supprimerPizza.php?pizzaASupprimer=" + leBouton).done(function (result) {
            console.log(result);
        });
        $(this).parent().remove();
    });
});