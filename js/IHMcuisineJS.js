
$(document).ready(function () {
    let interval ;

    function afficherCommande() {
        $("tbody").append("<tr class='alert alert-success'></tr>");
        $("tbody").children().last().load("dossierOF/3.txt");
    }
    $("#rafraichir").click(function () {
        afficherCommande();
    });
    $("#debut").click(function () {
       interval = setInterval(function () {
            alert("debut");
       }, 5000);
    });
    $("#fin").click(function () {
        clearInterval(interval);
    });
    $("#creer").click(function () {
        $.ajax({
            url: "RecupCommande.php",
            success: function (statut) {
                $("#feedback").html(statut);
            }
        });
    });
//    setInterval(function () {
//        $.ajax({
//            url: "ihm_livreur.php",
//            success: function (statut) {
//                $("#feedback").html(statut);
//                //alert("ActualisÃ©");
//            }
//        });
//    }, 5000);
});
