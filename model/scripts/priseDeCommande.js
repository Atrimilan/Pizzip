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

    $('.ajouterPizza').click(function (event) { // Ajouter une pizza au panier
        var selectedButton = event.target.id;
        var idElement = $('#' + selectedButton).attr('id').replace("incrementQuantite_", "");   // Récupérer ID de la pizza
        console.log("%cAjouter une pizza : " + $('#' + selectedButton).parent().find(".divPizza").attr('id'), "color:lightgreen");


        if (document.getElementById("panierPizza_" + idElement) == null) {  // Si l'élément n'existe pas dans le panier

            var divInfosPizza = $('#' + selectedButton).parent().find('.divPizza').attr('id');   // Div-parent des infos
            var panierNomPizza = $('#' + divInfosPizza).find('.nomPizza').text();       // Infos des pizzas
            var panierPrixPizza = $('#' + divInfosPizza).find('.prixPizza').text();     // *
            var panierTaillePizza = $('#' + divInfosPizza).find('.taillePizza').text(); // *
            var panierIngBase1 = $('#' + divInfosPizza).find('.ingBase1').text();       // *

            var panierQuantitePizza = 1;    // Quantité par défaut à 1
            $("#montantTotal").text(parseInt($("#montantTotal").text()) + parseInt(panierPrixPizza));

            console.log($('#' + divInfosPizza).find('.prixPizza').text());
            $('.listePanier').append("<div class='panierPizza' id='panierPizza_" + idElement + "'></div>");   // Ajouter une div dans le panier
            $('#panierPizza_' + idElement).append("<p>Pizza : <span class='nomPizza' id='panierNomPizza_" + idElement + "'>" + panierNomPizza + "</span></p>");
            $('#panierPizza_' + idElement).append("<p>Prix : <span class='prixPizza' id='panierPrixPizza_" + idElement + "'>" + panierPrixPizza + "</span> €</p>");
            $('#panierPizza_' + idElement).append("<p>Taille : <span class='taillePizza' id='panierTaillePizza_" + idElement + "'>" + panierTaillePizza + "</p>");
            $('#panierPizza_' + idElement).append("<p>Ingrédients : <span class='ingBase1' id='panierIngBase1_pizza_" + idElement + "'>" + panierIngBase1 + "</p>");
            $('#panierPizza_' + idElement).append("<p>Quantité : <span class='quantitePizza' id='panierQuantitePizza_" + idElement + "'>" + panierQuantitePizza + "</p>");
            $('#panierPizza_' + idElement).append("<input type='button' class='modifierPizza' id='modifierDetails_" + idElement + "' value='Modifier'>");
            $('#panierPizza_' + idElement).append("<input type='button' class='decrementQuantite' id='decrementQuantite_" + idElement + "' value='-'>");
            $('#panierPizza_' + idElement).append("<input type='button' class='supprimerPizza' id='supprimerPizza_" + idElement + "' value='Supprimer'>");
            $('#panierPizza_' + idElement).append("<div class='separationElementsPanier'><div>");   // ligne de séparation décorative
        } else {
            var panierElement = '#panierPizza_' + idElement;
            $(panierElement).find(".quantitePizza").text(parseInt($(panierElement).find(".quantitePizza").text()) + 1);

            var divInfosPizza = $('#' + selectedButton).parent().find('.divPizza').attr('id');   // Div-parent des infos
            var panierPrixPizza = $('#' + divInfosPizza).find('.prixPizza').text();
            $("#montantTotal").text(parseInt($("#montantTotal").text()) + parseInt(panierPrixPizza));
        }
    });

    $(document).on('click', '.decrementQuantite', function (event) { // Décrémenter UNE pizza
        var selectedButton = event.target.id;
        var idElement = $('#' + selectedButton).attr('id').replace("decrementQuantite_", "");   // Récupérer ID de la pizza
        console.log("%cDécrementer une pizza : " + $('#' + selectedButton).parent().attr('id'), "color:orange");

        var idPanierPizza = '#panierPizza_' + idElement;
        var panierPrixPizza = $(idPanierPizza).find('.prixPizza').text();   // Prix de la pizza
        $("#montantTotal").text(parseInt($("#montantTotal").text()) - parseInt(panierPrixPizza));   // Total = Total - PrixPizza

        if ($(idPanierPizza).parent().find('.quantitePizza').text() > 1) {  // Si quantité de pizza > 1
            $(idPanierPizza).find(".quantitePizza").text(parseInt($(idPanierPizza).find(".quantitePizza").text()) - 1); // Décrémenter quantité
        } else {
            $('#' + selectedButton).parent().remove();  // Si quantité == 1, Supprimer élément
        }
    });

    $(document).on('click', '.supprimerPizza', function (event) { // Supprimer une pizza du panier
        var selectedButton = event.target.id;
        var idElement = $('#' + selectedButton).attr('id').replace("supprimerPizza_", "");   // Récupérer ID de la pizza
        console.log("%cSupprimer une pizza : " + $('#' + selectedButton).parent().attr('id'), "color:red");

        var panierPrixPizza = $('#panierPizza_' + idElement).find('.prixPizza').text();
        $("#montantTotal").text(parseInt($("#montantTotal").text()) - ((parseInt(panierPrixPizza) * $('#panierPizza_' + idElement).find('.quantitePizza').text())));

        $('#panierPizza_' + idElement).remove();
    });

    $("#validerCommande").click(function () { // Validation de la commande

        let pizzaCommande = { // JSON pour contenir des pizzas et leur quantité
            numCommande: 0,
            /*taillePizza: 'L',*/
            pizza: []
        };
        let verifierPizzaNom, verifierPizzaQuantite;

        var nom, prenom, tel, adresse, codePostal, ville; // infos client
        var modeCommande, typeBoite, pizzaSelection; // infos commande

        modeCommande = 'modeCommande=' + $(".modeCommande").children('input[name="modeCommande"]:checked').val().trim();
        typeBoite = 'typeBoite=' + $(".boitePizza").children('input[name="typeBoite"]:checked').val().trim();


        pizzaSelection = 'pizzaSelection=';
        pizzaSelectionQuantite = 'selectionQuantite=';
        $(".listePanier > div").each(function () {
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
            /*pizzaCommande.taillePizza = $('#taillePizzaSelect option:selected').val().trim();
            console.log(pizzaCommande.taillePizza + "-------");*/
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