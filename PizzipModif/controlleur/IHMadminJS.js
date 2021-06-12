
$(document).ready(function () {
    interval = null;
    tabIngredient = [];

    $("#bouttonArchiver").click(function () {
        $('#bouttonArchiver').prop("disabled", true);
        $("#bouttonUtiliser").prop("disabled", false);
        tabIngredient = [];
        $("tbody").children().remove();
        clearInterval(interval);
        start("archiver");
    });
    $("#bouttonUtiliser").click(function () {
        $('#bouttonArchiver').prop("disabled", false);
        $("#bouttonUtiliser").prop("disabled", true);
        tabIngredient = [];
        $("tbody").children().remove();
        clearInterval(interval);
        start("utiliser");
    });
    function start(statut) {
        ajax(statut);
        interval = setInterval(function () {
            ajax(statut);
        }, 1000);
    }
    function ajax(statut) {
        if (statut === "archiver") {
            url = "../controlleur/RecupArchives.php";
        } else {
            url = "../controlleur/RecupDonner.php";
        }
        $.ajax({
            url: url,
            datatype: "json",
            success: function (data) {
                let result = JSON.parse((data));
                affichageIngredients(result, statut);
                actualiserIngredients(result);
            }
        });
    }
    function actualiserIngredients(mesIngredients) {
        for (let unIngredient in mesIngredients) {
            $("#estFrais" + unIngredient).val(mesIngredients[unIngredient]["frais"]);
            $("#Unite" + unIngredient).val(mesIngredients[unIngredient]["unité"]);
            $("#stockMin" + unIngredient).val(mesIngredients[unIngredient]["StockMin"]);
            $("#stockReel" + unIngredient).val(mesIngredients[unIngredient]["StockReel"]);
            $("#PUHT" + unIngredient).val(mesIngredients[unIngredient]["PrixUHT"]);
            $("#qtCommander" + unIngredient).val(mesIngredients[unIngredient]["Quantité à commander"]);

        }

    }
    function affichageIngredients(mesIngredients, statut) {
        let id = "";
        if (statut === "archiver") {
            id = "actualiser";
        } else {
            id = "archiver";
        }

        for (let unIngredient in mesIngredients) {
            if (tabIngredient.indexOf(unIngredient) == -1) {
                $("tbody").append("<tr id ='" + unIngredient + "'>" +
                        "<td>" + mesIngredients[unIngredient]["NomIngred"] + "</td>" +
                        "<td class='actualisation'>" +
                        "<div class='form-check'>" +
                        "<p>est frais : </p><p id='estfraiss'></p>" +
                        "<input id='estFrais" + unIngredient + "' type='text' required name='price' min='0' value=" + mesIngredients[unIngredient]["frais"] + " disabled> " +
                        "</div>" +
                        "<div class='form-check'>" +
                        "<p>Unité : </p><p id='Unite'></p>" +
                        "<input id='Unite" + unIngredient + "' type='text' required name='price' min='0' value=" + mesIngredients[unIngredient]["unité"] + " disabled> " +
                        "</div>" +
                        "<div class='form-check'>" +
                        "<p>Stock min : </p>" +
                        "<input id='stockMin" + unIngredient + "' class='pull-right' type='text' min='0'value=" + mesIngredients[unIngredient]["StockMin"] + " disabled> " +
                        "</div>" +
                        "<div class='form-check'>" +
                        "<p>Stock Reel : </p>" +
                        "<input id='stockReel" + unIngredient + "' class='pull-right' type='text' required name='price' min='0'value=" + mesIngredients[unIngredient]["StockReel"] + " disabled>" +
                        "</div>" +
                        "<div class='form-check'>" +
                        "<p>PUHT : </p>" +
                        "<input id='PUHT" + unIngredient + "' class='pull-right' type='text' required name='price' min='0'value=" + mesIngredients[unIngredient]["PrixUHT"] + " disabled> " +
                        "</div>" +
                        "<div class='form-check'>" +
                        "<p>Quantité à commander : </p>" +
                        "<input id='qtCommander" + unIngredient + "' class='pull-right' type='text' required name='price' min='0'value=" + mesIngredients[unIngredient]["Quantité à commander"] + " disabled> " +
                        "</div>" +
                        "</td>" +
                        "<td class='modification'>" +
                        "<div class='form-check'>" +
                        "<p>est frais : </p><p id='estfrais'></p>" +
                        "<select class='pull-right' name='est frais' id='ModifestFrais" + unIngredient + "'>" +
                        "<option value='Oui'>Oui</option>" +
                        "<option value='Non'>Non</opt>" +
                        "</select>" +
                        "</div>" +
                        "<div class='form-check'>" +
                        "<p>Unité : </p><p id='Unite'></p>" +
                        "<select class='pull-right' name='unite' id='ModifUnite" + unIngredient + "'>" +
                        "<option value='kilogramme'>kilogramme</option>" +
                        "<option value='gramme'>gramme</option>" +
                        "<option value='litre'>Litre</opt>" +
                        "<option value='pièce'>pièces</opt>" +
                        "</select>" +
                        "</div>" +
                        "<div class='form-check'>" +
                        "<p>Stock min : </p>" +
                        "<input class='pull-right' type='text' min='0' id='ModifstockMin" + unIngredient + "'>" +
                        "</div>" +
                        "<div class='form-check'>" +
                        "<p>Stock Réel : </p>" +
                        "<input class='pull-right' type='text' required name='price' min='0' id='ModifstockReel" + unIngredient + "'>" +
                        "</div>" +
                        "<div class='form-check'>" +
                        "<p>PUHT : </p>" +
                        "<input class='pull-right' type='text' required name='price' min='0' id='ModifPUHT" + unIngredient + "'>" +
                        "</div>" +
                        "<div class='form-check'>" +
                        "<p>Quantité à commander : </p>" +
                        "<input class='pull-right' type='text' required name='price' min='0' id = 'ModifqtCommander" + unIngredient + "'>" +
                        "</div>" +
                        "</td>" +
                        "<td>" +
                        "<button name='" + unIngredient + "' id ='modifier' class=' btn btn-success'>modifier</button>" +
                        "<button name ='" + unIngredient + "' id ='" + id + "' class=' btn btn-danger'>" + id + "</button>" +
                        "</td>" +
                        "</tr>");
                tabIngredient.push(unIngredient);
            }
        }
    }
    $("#bouttonAjouter").click(function () {
        let ingredient = $('#ajouterIngChamp').val();
        console.log("click");
        $.ajax({
            url: "../modele/Server.php",
            type: "POST",
            data: {
                ing: ingredient
            },
            datatype: "json",
            success: function (result) {
                result = JSON.parse(result);
                console.log(result == "non");
                if (result == "non") {
                    etat = " est déja présent";
                } else {
                    etat = " est ajouté"
                }
                $("#resultatAjout").empty();
                $("#resultatAjout").append("ingrédient " + ingredient + etat);


            }
        })
        $('#ajouterIngChamp').val("");
    })
    $("tbody").on('click', "button", function () {
        id = (this).name;
        name = (this).id;

        if (name == "modifier") {

            $.post(
                    "../controlleur/ModifierDonner.php", // Le fichier cible côté serveur.
                    {
                        id: id, // Nous supposons que ce formulaire existe dans le DOM.
                        estFrais: $("#ModifestFrais" + id).val(),
                        unité: $("#ModifUnite" + id).val(),
                        stockMin: $("#ModifstockMin" + id).val(),
                        stockReel: $("#ModifstockReel" + id).val(),
                        PUHT: $("#ModifPUHT" + id).val(),
                        qtàCommander: $("#ModifqtCommander" + id).val()

                    },
                    retour, // Nous renseignons uniquement le nom de la fonction de retour.
                    'json' // Format des données reçues.
                    );
            function retour(texte_recu) {
                if (texte_recu > 0) {
                    $("#" + id).remove();
                }
            }

        }
        if (name == "archiver") {
            console.log("click")
            $.post(
                    "../controlleur/ArchiverDonner.php", // Le fichier cible côté serveur.
                    {
                        id: id // Nous supposons que ce formulaire existe dans le DOM.

                    },
                    retour, // Nous renseignons uniquement le nom de la fonction de retour.
                    'json' // Format des données reçues.
                    );
            function retour(texte_recu) {
                if (texte_recu > 0) {
                    $("#" + id).remove();
                }
            }
        }
        if (name == "actualiser") {
            console.log("click")
            $.post(
                    "../controlleur/ActualiserDonner.php", // Le fichier cible côté serveur.
                    {
                        id: id // Nous supposons que ce formulaire existe dans le DOM.

                    },
                    retour, // Nous renseignons uniquement le nom de la fonction de retour.
                    'json' // Format des données reçues.
                    );
            function retour(texte_recu) {
                if (texte_recu > 0) {
                    $("#" + id).remove();
                }
            }

        }
    });

});
