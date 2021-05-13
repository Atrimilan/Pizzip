
$(document).ready(function () {
    let interval;

    function afficherCommande(numCom) {
        $("tbody").append("<tr class='alert alert-success'></tr>");
        $("tbody").children().last().load("dossierOF/" + numCom + ".txt");
    }
    $("#debut").click(function () {
        interval = setInterval(function () {
            $.ajax({
                url: "./RecupCommande.php",
                datatype: "json",
                success: function (data, statut) {
                    let tab = JSON.parse(data);
                    tab.forEach(element => afficherCommande(element));
                }
            });
        }, 5000);
    });
    $("#fin").click(function () {
        clearInterval(interval);
    });
});
