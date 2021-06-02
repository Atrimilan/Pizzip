
// ----- Actualiser la page -----
setInterval(function() {
    $.ajax({
        url: "http://localhost/coursphp/Pizzip/controller/action_chargerCommandeLivraison.php",
        success: function (data) {
            console.log("Actualisé JSON 1");
        }
    });
}, 100 * 60);

setInterval(function() {
    $.ajax({
        url: "http://localhost/coursphp/Pizzip/model/scripts/tout.php",
        success: function (data) {
            console.log("Actualisé JSON Complet");
        }
    });
}, 100 * 60);