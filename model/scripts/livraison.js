
// ----- Actualiser la page -----

setInterval(function() {
    $.ajax({
        url: "http://localhost/coursphp/Pizzip/model/scripts/chargerTouteLivraison.php",
        success: function (data) {
            console.log("Actualisé JSON Complet");
        }
    });
}, 100 * 60);