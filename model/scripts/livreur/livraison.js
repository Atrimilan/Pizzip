
// ----- Actualiser la page -----
setInterval(function() {
    $.ajax({
        url: "http://localhost/Pizzip/controller/livreur/chargerTouteLivraison.php",
        success: function (data) {
            console.log("Actualisé JSON Complet");
        }
    });
}, 100 * 60);