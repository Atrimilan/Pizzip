

// ----- Actualiser la page -----
setInterval(function() {
    $.ajax({
        url: "ihm_livreur.php",
        success: function (data) {
            $("#feedback").html(data);
            //alert("Actualisé");
            window.location.reload(); // rafraichit la page
        }
    });
}, 100 * 60);


req.open("GET", "ihm_livreur.php", true);
$('#IDbalise').load('ihm_livreur.php');
