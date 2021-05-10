

// ----- Actualiser la page -----
setInterval(function() {
    $.ajax({
        url: "ihm_livreur.php",
        success: function (data) {
            $("#feedback").html(data);
            //alert("Actualisé");
        }
    });
}, 1000 * 60);
