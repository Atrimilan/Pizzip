
$(document).ready(function () {
    let interval;

    function afficherCommande(numCom) {
        $("tbody").append("<tr class='ligne' id='" + numCom + "'></tr><br>");
        $("tbody").children().last().load("../Modele/dossierOF/" + numCom + ".txt");
    }
    $("#debut").click(function () {
        interval = setInterval(function () {
            $.ajax({
                url: "../Modele/RecupCommande.php",
                datatype: "json",
                success: function (data) {
                    let tab = JSON.parse(data);
                    tab.forEach(element => afficherCommande(element));
                }
            });
        }, 5000);
    });
    $("tbody").on('click', "input", function () {
        let numCom=((this).name)
        $("ligne").css("background-Color","red");
        console.log(numCom);
        switch ((this).value) {
            case "accepter":
                 console.log("1");
                changementEtat("acceptee",numCom);
                break;
            case "enPrepa":
                console.log("2");
                changementEtat("enPreparation",numCom);
                break;
            case "prete":
                console.log("3");
                changementEtat("prete",numCom);
                break;
            case "livree":
                console.log("4");
                changementEtat("livree",numCom);
                break;
        }
    });

    function changementEtat(etat,numCom) {
        console.log(numCom);
        $.post("../Modele/ChangementEtat.php", {etat: etat,numCom:numCom});
    }

    $("#fin").click(function () {
        clearInterval(interval);
        $.get("../Modele/Supression.php");
    });
});
