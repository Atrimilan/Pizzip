$(document).ready(function() {

    var listeIngredientsJSON;   // JSON Ingrédients - Récupération AJAX des ingrédients

    $.getJSON("./recupIngred.php").done(function (result) {   // Requete AJAX - Récupérer tous les ingrédients
        listeIngredientsJSON = result;
        console.log(result);    
        listeIngredientsJSON.listeIngredients.forEach(function (ingredActuel) {  // pour chaque ingrédient (base/opt), on l'ajoute en option de chaque select
            $('select[id="ajouterPizzaIng"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>"); //
        });
    });

    // ENVOI LES DONNEES AU FICHIER PHP
    $("#bouttonAjouterPizza").click(function(){
        let pizza = $('#ajouterPizzaNom').val();
        let ingr = $('select[name=ajouterPizzaIng]').val();
        let prix= $('#ajouterPizzaPrix').val();
        
        $.ajax({
            url:"./ServerPizza.php",
            type:"POST",
            data: {
                piz: pizza,
                ingr: ingr,
                prix: prix
            },
            datatype: "json",
            success : function(result){
               console.log(result);
            },
            error: function (err) {
                console.log(err);
            }
        })
    })
})
