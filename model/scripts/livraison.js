

// ----- Actualiser la page -----
setInterval(function() {
    $.ajax({
        url: "action_chargerCommandeLivraison.php",
        success: function (data) {
            console.log("Actualisé");
        }
    });
}, 100 * 60);