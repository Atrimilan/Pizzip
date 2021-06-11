$(document).ready(function () {
    //----------------------------------------------------------------
    //-- RECUPERATION DES DONNES POUR AFFICHER LA LISTE DES PIZZAS ---
    //----------------------------------------------------------------

    var listePizzaJSON;

    $.getJSON("../../../controller/listePizza.php").done(function (result) {
        listePizzaJSON = result;
        console.log(result);
        listePizzaJSON.listePizza.forEach(function (pizzaActuel) {
            console.log(pizzaActuel);
            $('body').append('<p>' + pizzaActuel + '<button id="' + pizzaActuel + '" class="Supprimer">Supprimer</button> </p>');
        });
    });


    $('body').find('.Supprimer').click(function (event) {
        let leBouton = event.target.id;
        console.log(leBouton);

        $.getJSON("../../../controller/supprimerPizza.php?pizzaASupprimer=" + leBouton).done(function (result) {
            console.log(result);
        });
    });
});