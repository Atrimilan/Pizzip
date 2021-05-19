
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
        switch ((this).value) {
            case "accepter":
                $(this).prop("disabled", true);
                changementEtat("acceptee", numCom);
                $("#" + numCom).addClass("alert alert-light");
                break;
            case "enPrepa":
                changementEtat("enPreparation", numCom);
                $("#" + numCom).addClass("alert alert-danger");
                break;
            case "prete":
                changementEtat("prete", numCom);
                $("#" + numCom).addClass("alert alert-warning");
                break;
            case "N":
                changementEtat("livree", numCom);
                $("#" + numCom).addClass("alert alert-success");
                break;
            case "O":
                $("#" + numCom).addClass("alert alert-success");
                break;
        }
    });
    function changementEtat(etat, numCom) {
        $.post("../Modele/ChangementEtat.php", {etat: etat, numCom: numCom});
    }

    $("#fin").click(function () {
        $("#debut").prop("disabled", false);
        clearInterval(interval);
        $.get("../Modele/Supression.php");
        $("tbody").children().remove();
    });
});
