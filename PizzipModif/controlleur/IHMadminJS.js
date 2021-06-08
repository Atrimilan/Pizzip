$(document).ready(function () {


    interval = setInterval(function () {
        $.ajax({
            url: "../controlleur/RecupDonner.php",
            datatype: "json",
            success: function (data) {
                let result = JSON.parse((data))
                affichageIngredients(result)
            }
        });
    }, 10000);
})
function affichageIngredients(mesIngredients) {

    console.log(mesIngredients);


}
$("#bouttonAjouter").click(function () {
    let ingredient = $('#ajouterIngChamp').val();
    console.log("click");
    $.ajax({
        url: "../modele/Server.php",
        type: "POST",
        data: {
            ing: ingredient
        },
        datatype: "json",
        success: function (result) {
            console.log(result);
        }
    })
    $('#ajouterIngChamp').val("");
})
