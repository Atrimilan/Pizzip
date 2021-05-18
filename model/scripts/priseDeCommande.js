var doc = document;
var currentBoxMod = "carton";

$(doc).ready(function () {


    $('input[name=typeBoite]').click(function () { // changer le type de boite : carton - thermo
        var spanMontantTotal = $('#montantTotal');
        var selectedBoxMod = $("input[name='typeBoite']:checked").val();
        if (selectedBoxMod == "carton" && currentBoxMod != "carton") { // Si on clique sur Carton, et qu'il n'était pas déjà sélectionné
            spanMontantTotal.text(parseInt(spanMontantTotal.text()) - 3);
            currentBoxMod = "carton";
        } else if (selectedBoxMod == "isotherme" && currentBoxMod != "isotherme") {
            spanMontantTotal.text(parseInt(spanMontantTotal.text()) + 3);
            currentBoxMod = "isotherme";
        }
    });

    $('input[name=modeCommande]').click(function () { // changer le type de commande : livrée - à emporter
        var selectedMod = $("input[name='modeCommande']:checked").val();
        if (selectedMod == "livraison") {
            $('#offreAEmporter').hide();
            $('#offreLivraison').show();
            $(".infosClient > input").each(function () {
                $(this).show();
            });
        } else if (selectedMod == "aEmporter") {
            $('#offreLivraison').hide();
            $('#offreAEmporter').show();
            $(".infosClient > input").each(function () {
                if ($(this).attr('name') != "nom" && $(this).attr('name') != "prenom" && $(this).attr('name') != "telephone") {
                    $(this).hide();
                }
            });
        }
    });

    $('.ajusterQuantite').click(function (event) { // modifier la quantité par pizza
        var selectedButton = event.target.id;
        var spanQuantite = $('#' + selectedButton).parent().find("span");
        var prixPizza = $('#' + selectedButton).parent().parent().find(".prixPizza");
        var spanMontantTotal = $('#montantTotal');

        if ($('#' + selectedButton).val() == "+") {
            spanQuantite.text(parseInt(spanQuantite.text()) + 1);
            spanMontantTotal.text(parseInt(spanMontantTotal.text()) + parseInt(prixPizza.text()))
        } else if ($('#' + selectedButton).val() == "-") {
            if (parseInt(spanQuantite.text()) != 0) { // Ne pas aller dans le négatif
                spanQuantite.text(parseInt(spanQuantite.text()) - 1);
                spanMontantTotal.text(parseInt(spanMontantTotal.text()) - parseInt(prixPizza.text()))
            }
        }

        verifierSelections(selectedButton, spanQuantite); // Repère visuel des sélections par coloration des divs 
    });

    function verifierSelections(selectedButton, spanQuantite) { // changer la couleurs des pizzas sélectionnées
        var selectedPizza = $('#' + selectedButton).parent().parent().children(".divPizza");
        var selectedPizzaQuantite = $('#' + selectedButton).parent().parent().children(".divQuantite");
        if (parseInt(spanQuantite.text()) > 0) {
            selectedPizza.css("background-color", "rgb(130, 130, 135)");
            selectedPizzaQuantite.css("background-color", "rgb(102, 102, 107)");
        } else {
            selectedPizza.css("background-color", "rgb(110, 110, 115)");
            selectedPizzaQuantite.css("background-color", "rgb(82, 82, 87)");
        }
    }

    $("#validerCommande").click(function () { // Validation de la commande

        let pizzaCommande = { // JSON pour contenir des pizzas et leur quantité
            numCommande: 0,
            pizza: []
        };
        let verifierPizzaNom, verifierPizzaQuantite;

        var nom, prenom, tel, adresse, codePostal, ville; // infos client
        var modeCommande, typeBoite, pizzaSelection, taillePizza; // infos commande

        modeCommande = 'modeCommande=' + $(".modeCommande").children('input[name="modeCommande"]:checked').val().trim();
        typeBoite = 'typeBoite=' + $(".boitePizza").children('input[name="typeBoite"]:checked').val().trim();


        pizzaSelection = 'pizzaSelection=';
        pizzaSelectionQuantite = 'selectionQuantite=';
        $(".listePizza > div").each(function () {
            if (parseInt($(this).find('.quantitePizza').text()) > 0) {
                pizzaSelection = $(this).find('.nomPizza').text() + ",";
                pizzaSelectionQuantite = $(this).find('.quantitePizza').text() + ",";

                var unePizza = {
                    nomPizza: pizzaSelection,
                    quantitePizza: pizzaSelectionQuantite
                };

                pizzaCommande['pizza'].push(unePizza);
            }
        });

        taillePizza = 'taillePizza=' + $('#taillePizzaSelect option:selected').val().trim();

        nom = 'nom=' + $(".infosClient").children('input[name="nom"]').val().trim();
        prenom = 'prenom=' + $(".infosClient").children('input[name="prenom"]').val().trim();
        tel = 'tel=' + $(".infosClient").children('input[name="telephone"]').val().trim();

        if (modeCommande == "modeCommande=livraison") {
            // Données utiles seulement dans le cas d'une livraison
            adresse = 'adresse=' + $(".infosClient").children('input[name="adresse"]').val().trim();
            codePostal = 'codePostal=' + $(".infosClient").children('input[name="codePostal"]').val().trim();
            ville = 'ville=' + $(".infosClient").children('input[name="ville"]').val().trim();
        }

        console.log("%c--- Validation de la commande ---", "color:red; font-weight:bold"); // Debut d'AJAX
        console.log(pizzaCommande);

        try {
            verifierPizzaNom = "verifPizza=" + pizzaCommande.pizza[0].nomPizza; // Envoyer une pizza (une commande ne peut pas être vide)
            verifierPizzaQuantite = "verifPizzaQuant=" + pizzaCommande.pizza[0].quantitePizza; // Quantité supérieure à 0 (si on touche au code source)
        } catch (error) {
            console.log("%cPas de pizza sélectionnée\nImpossible de passer la commande", "color:salmon");
        }

        var lienAPI = 'http://localhost/CNAM/Pizzip/controller/enregistrerCommande.php';
        var parametres = nom + '&' + prenom + '&' + modeCommande + '&' + typeBoite + '&' + tel + '&' + adresse + '&' + codePostal + '&' + ville + '&' + verifierPizzaNom + '&' + verifierPizzaQuantite;
        console.log("Requete : " + lienAPI + '?' + parametres);

        $.getJSON(lienAPI + '?' + parametres).done(function (result) { // Requete AJAX - Save + Check des données utilisateur
            console.log("%cSuccess - COMMANDE: %c" + result.success, "color:gold", "color:white");
            console.log("%cNuméro de commande: %c" + result.numCom, "color:lightgreen", "color:white");
            pizzaCommande.numCommande = result.numCom;
            if (result.success == true) {   // Si les données utilisateurs ont pu être enregistrées, on peut enregistrer les pizzas
                $.ajax({
                    type: 'POST',
                    url: 'http://localhost/CNAM/Pizzip/controller/enregistrerPizza.php',
                    data: JSON.stringify(pizzaCommande),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function (resultat) {
                        console.log("---------------");
                        console.log(resultat);
                        //console.log("%cSuccess - DETAIL: %c" + resultat.success, "color:gold", "color:white");
                        //console.log(resultat.data);
                    },
                    error: function (errMsg) {
                        console.log("Erreur" + errMsg);
                    }
                });
            }
        });
    });
});