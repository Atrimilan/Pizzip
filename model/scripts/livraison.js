
// ----- Actualiser la page -----
setInterval(function() {
    $.ajax({
        url: "http://localhost/coursphp/Pizzip/controller/action_chargerCommandeLivraison.php",
        success: function (data) {
            console.log("Actualisé JSON");
        }
    });
}, 100 * 60);