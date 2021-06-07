$(document).ready(function () {
    let interval;
    let Index;

    function afficherCommande(numCom) {
        $("tbody").append("<tr class='alert alert-light' id='" + numCom + "'></tr>");
        $("tbody").children().last().load("../Modele/dossierOF/" + numCom + ".txt");
    }
    $("#debut").click(function () {
        $("#debut").prop("disabled", true);
        console.log("click");
        interval = setInterval(function () {          
            $.ajax({
                url: "../Controller/RecupData.php",
                datatype: "json",
                success: function (data) {
                    let tab = JSON.parse(data);
                    tab.forEach(element => afficherCommande(element));
                }
            });
        }, 10000);
    });
    $("tbody").on('click', "input", function () {
        let numCom = ((this).name);
        let classe = $("#" + numCom).attr('class');
        $("#" + numCom).removeClass(classe);
         $('input[name='+numCom+']').css('background-color', '#C0C0C0');
         $(this).css('background-color', '#34ce57');
        switch ((this).value) {
            case "acceptée":          
                changementEtat("acceptee", numCom);
                $("#" + numCom).addClass("alert alert-light");
                break;
            case "en cours de préparation":
                changementEtat("enPreparation", numCom);
                $("#" + numCom).addClass("alert alert-danger");
                break;
            case "préte":
                changementEtat("prete", numCom);
                $("#" + numCom).addClass("alert alert-warning");
                break;
            case "récupérée par le client":
                changementEtat("livree", numCom);
                $("#" + numCom).addClass("alert alert-success");
                break;
            case "récupérée par le livreur":
                $("#" + numCom).addClass("alert alert-success");
                break;
        }
    });
    function changementEtat(etat, numCom) {
        $.post("../Controller/ChangementEtat.php", {etat: etat, numCom: numCom});
    }

    $("#fin").click(function () {
        $("#debut").prop("disabled", false);
        clearInterval(interval);
        $.get("../Modele/Supression.php");
        $("tbody").children().remove();
    });
});
