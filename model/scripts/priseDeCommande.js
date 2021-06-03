var doc = document;
var currentBoxMod = "carton";
var listeIngredientsJSON;   // JSON Ingrédients - Récupération AJAX des ingrédients ligne 7

$(doc).ready(function () {

    $.getJSON("http://localhost/CNAM/Pizzip/controller/listeIngred.php").done(function (result) {   // Requete AJAX - Récupérer tous les ingrédients
        listeIngredientsJSON = result;
        console.log(result);
    });

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
        console.log("%cAjout d'une pizza : " + $('#' + selectedButton).parent().find(".divPizza").attr('id'), "color:lightgreen");


        if (document.getElementById("panierPizza_" + idElement) == null) {  // Si l'élément n'existe pas dans le panier

            var divInfosPizza = $('#' + selectedButton).parent().find('.divPizza').attr('id');   // Div-parent des infos
            var panierNomPizza = $('#' + divInfosPizza).find('.nomPizza').text();       // Infos des pizzas
            var panierPrixPizza = $('#' + divInfosPizza).find('.prixPizza').text();     // *
            var panierTaillePizza = $('#' + divInfosPizza).find('.taillePizza').text(); // *
            var panierIngBase1 = $('#' + divInfosPizza).find('.ingBase1').text();       // *

            var panierQuantitePizza = 1;    // Quantité par défaut à 1
            $("#montantTotal").text(parseInt($("#montantTotal").text()) + parseInt(panierPrixPizza));

            console.log("%c>>> Prix : " + $('#' + divInfosPizza).find('.prixPizza').text() + " €", "color:lightgreen");
            $('.listePanier').append("<div class='panierPizza' id='panierPizza_" + idElement + "'></div>");   // Ajouter une div dans le panier
            $('#panierPizza_' + idElement).append("<input type='button' class='supprimerPizza' id='supprimerPizza_" + idElement + "' value='X'>");  // BOUTON SUPPRESSION
            $('#panierPizza_' + idElement).append("<p>Pizza : <span class='nomPizza' id='panierNomPizza_" + idElement + "'>" + panierNomPizza + "</span></p>");
            $('#panierPizza_' + idElement).append("<p>Prix : <span class='prixPizza' id='panierPrixPizza_" + idElement + "'>" + panierPrixPizza + "</span> €</p>");
            $('#panierPizza_' + idElement).append("<p>Taille : <span class='taillePizza' id='panierTaillePizza_" + idElement + "'>" + panierTaillePizza + "</p>");
            $('#panierPizza_' + idElement).append("<p>Ingrédients : <span class='ingBase1' id='panierIngBase1_pizza_" + idElement + "'>" + panierIngBase1 + "</p>");
            $('#panierPizza_' + idElement).append("<p>Quantité : <span class='quantitePizza' id='panierQuantitePizza_" + idElement + "'>" + panierQuantitePizza + "</p>");
            $('#panierPizza_' + idElement).append("<a href='javascript:void(0)' class='modifierPizza' id='modifierDetails_" + idElement + "'> Editer</a>"); // BOUTON EDITION
            $('#panierPizza_' + idElement).append("<input type='button' class='decrementQuantite' id='decrementQuantite_" + idElement + "' value='Enlever une'>");  // BOUTON DECREMENTATION
            $('#panierPizza_' + idElement).append("<div class='separationElementsPanier'><div>");   // ligne de séparation décorative
        } else {
            var panierElement = '#panierPizza_' + idElement;
            var nouvelleQuantite = parseInt(parseInt($(panierElement).find(".quantitePizza").text()) + 1);
            $(panierElement).find(".quantitePizza").text(nouvelleQuantite);

            var divInfosPizza = $('#' + selectedButton).parent().find('.divPizza').attr('id');   // Div-parent des infos
            var panierPrixPizza = $('#' + divInfosPizza).find('.prixPizza').text();
            $("#montantTotal").text(parseInt($("#montantTotal").text()) + parseInt(panierPrixPizza));
        }
    });

    $(document).on('click', '.modifierPizza', function (event) { // Modifier une pizza
        $('.editionContainer').css("display", "block");
        $('.contourNoir').css("display", "block");
        $('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Ingrédient 1 :</p><select class='editionIng' name='editionIngBase1'><select></div>");  // ajouter un select pour tous les ingrédients
        $('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Ingrédient 2 :</p><select class='editionIng' name='editionIngBase2'><select></div>");  // de base et ingrédients optionnels (ingBase1 à 4
        $('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Ingrédient 3 :</p><select class='editionIng' name='editionIngBase3'><select></div>");  // et ingOpt1 à 4)
        $('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Ingrédient 4 :</p><select class='editionIng' name='editionIngBase4'><select></div>");  // ..
        $('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Option 1 :</p><select class='editionIng' name='editionIngOpt1'><select></div>");       // ..
        $('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Option 2 :</p><select class='editionIng' name='editionIngOpt2'><select></div>");       // ..
        $('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Option 3 :</p><select class='editionIng' name='editionIngOpt3'><select></div>");
        $('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Option 4 :</p><select class='editionIng' name='editionIngOpt4'><select></div>");

        i = 0;
        listeIngredientsJSON.listeIngredients.forEach(function (ingredActuel) {  // pour chaque ingrédient, on l'ajoute en option à chaque select
            $('select[name="editionIngBase1"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>"); // ..
            $('select[name="editionIngBase2"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>"); // ..
            $('select[name="editionIngBase3"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>"); // ..
            $('select[name="editionIngBase4"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>");
            $('select[name="editionIngOpt1"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>");
            $('select[name="editionIngOpt2"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>");
            $('select[name="editionIngOpt3"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>");
            $('select[name="editionIngOpt4"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>");
        });
        let boutonEditer = event.target.id;
        var nomPizzaATrouver = $('#' + boutonEditer).parent().find('.nomPizza').text(); // Récupérer le nom de la pizza qu'on Edit

        console.log(listeIngredientsJSON.listePizza[nomPizzaATrouver]);

        var nomPizzaJSON = listeIngredientsJSON.listePizza[nomPizzaATrouver];   // Récupérer les ingrédients de la pizza, grâce au JSON chargé au départ

        $('select[name="editionIngBase1"]').val(nomPizzaJSON.IngBase1.toLowerCase()).change();  // Sélectionner les options selon les ingrédients correspondants
        $('select[name="editionIngBase2"]').val(nomPizzaJSON.IngBase2.toLowerCase()).change();  // à la pizza de base
        $('select[name="editionIngBase3"]').val(nomPizzaJSON.IngBase3.toLowerCase()).change();  // ...
        $('select[name="editionIngBase4"]').val(nomPizzaJSON.IngBase4.toLowerCase()).change();  // ...
        $('select[name="editionIngOpt1"]').val(nomPizzaJSON.IngOpt1.toLowerCase()).change();    // ...
        $('select[name="editionIngOpt2"]').val(nomPizzaJSON.IngOpt2.toLowerCase()).change();
        $('select[name="editionIngOpt3"]').val(nomPizzaJSON.IngOpt3.toLowerCase()).change();
        $('select[name="editionIngOpt4"]').val(nomPizzaJSON.IngOpt4.toLowerCase()).change();
    });

    $(document).on('keyup', function (e) {   // Appuyer sur Echap pour fermer le Pop Up
        if (e.key == "Escape") $('.fermerModifierPizza').click();
    });

    $('.contourNoir').on('click', function (e) {    // Click dans la zone sombre pour fermer le Pop Up
        $('.fermerModifierPizza').click();
    });

    $(document).on('click', '.fermerModifierPizza', function (event) { // Fermer le Pop Up d'édition (avec la croix)
        $('.editionContainer').css("display", "none");
        $('.contourNoir').css("display", "none");
        $(".editionBlock").remove();  // Supprimer tous les select pour eviter une fuite de mémoire par duplication
    });

    $(document).on('click', '.decrementQuantite', function (event) { // Décrémenter UNE pizza
        var selectedButton = event.target.id;
        var idElement = $('#' + selectedButton).attr('id').replace("decrementQuantite_", "");   // Récupérer ID de la pizza
        console.log("%cDécrementer une pizza : " + $('#' + selectedButton).parent().attr('id'), "color:orange");

        var idPanierPizza = '#panierPizza_' + idElement;
        var panierPrixPizza = $(idPanierPizza).find('.prixPizza').text();   // Prix de la pizza
        $("#montantTotal").text(parseInt($("#montantTotal").text()) - parseInt(panierPrixPizza));   // Total = Total - PrixPizza

        if ($(idPanierPizza).find('.quantitePizza').text() > 1) {  // Si quantité de pizza > 1
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
                        console.log(resultat);
                        //console.log("%cSuccess - DETAIL: %c" + resultat.success, "color:gold", "color:white");
                        //console.log(resultat.data);
                        if (resultat.success == true) {
                            let url = 'http://localhost/CNAM/Pizzip/view/pages/finCommande.php';    // URL - Page de fin de commande

                            adresseComplete = $("input[name='adresse']").val() + ' - ' + $("input[name='ville']").val();  // $_POST['adr']
                            let prixTotal = $('#montantTotal').text();  // $_POST['total']
                            let timeMax = 45;
                            let timeMin = 30;
                            let time = Math.floor(Math.random() * (timeMax - timeMin + 1) + timeMin);   // $_POST['time']
                            let firstname = $("input[name='prenom']").val();  // $_POST['name']

                            var form = $('<form action="' + url + '" method="post" hidden>' +
                                '<input type="text" name="name" value="' + firstname + '" />' +
                                '<input type="text" name="adr" value="' + adresseComplete + '" />' +
                                '<input type="text" name="total" value="' + prixTotal + '" />' +
                                '<input type="text" name="time" value="' + time + '" />' +
                                '</form>');
                            $('body').append(form); // placer le form dans la fenêtre
                            form.submit();  // submit le formulaire => donc redirection avec les paramètres POST
                        }
                    },
                    error: function (errMsg) {
                        console.log("Erreur" + errMsg);
                    }
                });
            }
        });
    });
});