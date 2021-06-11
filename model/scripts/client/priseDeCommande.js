var doc = document;
var currentBoxMod = "carton";
var listeIngredientsJSON;   // JSON Ingrédients - Récupération AJAX des ingrédients ligne 8
var boutonEditer;

$(doc).ready(function () {

    $.getJSON("http://localhost/Pizzip/controller/client/listeIngred.php").done(function (result) {   // Requete AJAX - Récupérer tous les ingrédients
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
            var panierIngBase2 = $('#' + divInfosPizza).find('.ingBase2').text();       // *
            var panierIngBase3 = $('#' + divInfosPizza).find('.ingBase3').text();       // *
            var panierIngBase4 = $('#' + divInfosPizza).find('.ingBase4').text();       // *
            var panierIngOpt1 = $('#' + divInfosPizza).find('.ingOpt1').text();         // *
            var panierIngOpt2 = $('#' + divInfosPizza).find('.ingOpt2').text();         // *
            var panierIngOpt3 = $('#' + divInfosPizza).find('.ingOpt3').text();         // *
            var panierIngOpt4 = $('#' + divInfosPizza).find('.ingOpt4').text();         // *

            var panierQuantitePizza = 1;    // Quantité par défaut à 1
            $("#montantTotal").text(parseInt($("#montantTotal").text()) + parseInt(panierPrixPizza));

            console.log("%c>>> Prix : " + $('#' + divInfosPizza).find('.prixPizza').text() + " €", "color:lightgreen");
            $('.listePanier').append("<div class='panierPizza' id='panierPizza_" + idElement + "'></div>");   // Ajouter une div dans le panier
            $('#panierPizza_' + idElement).append("<input type='button' class='supprimerPizza' id='supprimerPizza_" + idElement + "' value='X'>");  // BOUTON SUPPRESSION
            $('#panierPizza_' + idElement).append("<p>Pizza : <span class='nomPizza' id='panierNomPizza_" + idElement + "'>" + panierNomPizza + "</span></p>");
            $('#panierPizza_' + idElement).append("<p>Prix : <span class='prixPizza' id='panierPrixPizza_" + idElement + "'>" + panierPrixPizza + "</span> €</p>");
            $('#panierPizza_' + idElement).append("<p>Taille : <span class='taillePizza' id='panierTaillePizza_" + idElement + "'>" + panierTaillePizza + "</span></p>");
            $('#panierPizza_' + idElement).append("<p>Ingrédients : <span class='ingBase1' id='panierIngBase1_pizza_" + idElement + "'>" + panierIngBase1 + "</span> " +    // Insérer un texte Ingrédients Pizza
                "<span class='ingBase2' id='panierIngBase1_pizza_" + idElement + "'>" + panierIngBase2 + "</span> " +   // Insérer les ingrédients dans des spans
                "<span class='ingBase3' id='panierIngBase1_pizza_" + idElement + "'>" + panierIngBase3 + "</span> " +   // ...
                "<span class='ingBase4' id='panierIngBase1_pizza_" + idElement + "'>" + panierIngBase4 + "</span>" +    // ...
                "</p>");
            $('#panierPizza_' + idElement).append("<p class='optionsPizza'></p>");  // Insérer un texte Options Pizza
            if (panierIngOpt1 != "" || panierIngOpt2 != "" || panierIngOpt3 != "" || panierIngOpt4 != "") { // Ecrire dans Options Pizza si au moins une option est présente
                $('#panierPizza_' + idElement).find(".optionsPizza").append("Options : <span class='ingOpt1' id='panierIngBase1_pizza_" + idElement + "'>" + panierIngOpt1 + "</span> " +
                    "<span class='ingOpt2' id='panierIngBase1_pizza_" + idElement + "'>" + panierIngOpt2 + "</span> " + // Insérer les option dans des spans
                    "<span class='ingOpt3' id='panierIngBase1_pizza_" + idElement + "'>" + panierIngOpt3 + "</span> " + // ...
                    "<span class='ingOpt4' id='panierIngBase1_pizza_" + idElement + "'>" + panierIngOpt4 + "</span>");  // ...
            }
            $('#panierPizza_' + idElement).append("<p>Quantité : <span class='quantitePizza' id='panierQuantitePizza_" + idElement + "'>" + panierQuantitePizza + "</span></p>");
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
        //$('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Ingrédient 1 :</p><select class='editionIng' name='editionIngBase1'><select></div>");  // ajouter un select pour tous les ingrédients
        //$('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Ingrédient 2 :</p><select class='editionIng' name='editionIngBase2'><select></div>");  // de base et ingrédients optionnels (ingBase1 à 4
        //$('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Ingrédient 3 :</p><select class='editionIng' name='editionIngBase3'><select></div>");  // et ingOpt1 à 4)
        //$('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Ingrédient 4 :</p><select class='editionIng' name='editionIngBase4'><select></div>");  // ..
        //$('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Option 1 :</p><select class='editionIng' name='editionIngOpt1'><select></div>");       // ..
        //$('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Option 2 :</p><select class='editionIng' name='editionIngOpt2'><select></div>");       // ..
        //$('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Option 3 :</p><select class='editionIng' name='editionIngOpt3'><select></div>");
        //$('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Option 4 :</p><select class='editionIng' name='editionIngOpt4'><select></div>");

        //listeIngredientsJSON.listeIngredients.forEach(function (ingredActuel) {  // pour chaque ingrédient (base/opt), on l'ajoute en option de chaque select
        //$('select[name="editionIngBase1"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>"); // ..
        //$('select[name="editionIngBase2"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>"); // ..
        //$('select[name="editionIngBase3"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>"); // ..
        //$('select[name="editionIngBase4"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>");
        //$('select[name="editionIngOpt1"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>");
        //$('select[name="editionIngOpt2"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>");
        //$('select[name="editionIngOpt3"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>");
        //$('select[name="editionIngOpt4"]').append("<option value='" + ingredActuel + "'>" + ingredActuel + "</option>");
        //});
        boutonEditer = event.target.id;
        var nomPizzaATrouver = $('#' + boutonEditer).parent().find('.nomPizza').text(); // Récupérer le nom de la pizza qu'on Edit

        for (let i = 1; i < 4; i++) {   // Pour les options de 1 à 4
            if (listeIngredientsJSON.listePizza[nomPizzaATrouver]['IngOpt' + i] != "") {    // Ajouter un <select> de l'Option
                $('.editionContainer').append("<div class='editionBlock'><p class='editionTitre'>Option " + i + " :</p><select class='editionIng' name='editionIngOpt" + i + "'><select></div>");
                $('select[name="editionIngOpt' + i + '"]').append("<option value=''></option>");
                for (let j = 1; j < 4; j++) {   // Pour les options de 1 à 4
                    if (listeIngredientsJSON.listePizza[nomPizzaATrouver]['IngOpt' + j] != "") {    // Ajouter chaque Option dans <option>
                        $('select[name="editionIngOpt' + i + '"]').append("<option value='" + listeIngredientsJSON.listePizza[nomPizzaATrouver]['IngOpt' + j] + "'>" + listeIngredientsJSON.listePizza[nomPizzaATrouver]['IngOpt' + j] + "</option>");
                    }
                }
            };
        }

        var nomPizzaJSON = listeIngredientsJSON.listePizza[nomPizzaATrouver];   // Récupérer les ingrédients de la pizza, grâce au JSON chargé au départ
        console.log(listeIngredientsJSON.listePizza[nomPizzaATrouver]);

        //$('select[name="editionIngBase1"]').val(nomPizzaJSON.IngBase1).change();  // Sélectionner les options selon les ingrédients correspondants
        //$('select[name="editionIngBase2"]').val(nomPizzaJSON.IngBase2).change();  // à la pizza de base
        //$('select[name="editionIngBase3"]').val(nomPizzaJSON.IngBase3).change();  // ...
        //$('select[name="editionIngBase4"]').val(nomPizzaJSON.IngBase4).change();  // ...
        //$('select[name="editionIngOpt1"]').val(nomPizzaJSON.IngOpt1).change();    // ...
        //$('select[name="editionIngOpt2"]').val(nomPizzaJSON.IngOpt2).change();
        //$('select[name="editionIngOpt3"]').val(nomPizzaJSON.IngOpt3).change();
        //$('select[name="editionIngOpt4"]').val(nomPizzaJSON.IngOpt4).change();
    });

    $(document).on('keyup', function (e) {   // RACCOURCIS - Appuyer sur Echap pour fermer le Pop Up
        if (e.key == "Escape") $('.fermerModifierPizza').click();   // Simule un click sur la croix
    });
    $('.contourNoir').on('click', function (e) {    // RACCOURCIS - Click dans la zone sombre pour fermer le Pop Up
        $('.fermerModifierPizza').click();  // Simule un click sur la croix
    });

    $(document).on('click', '.fermerModifierPizza', function (event) { // Fermer le Pop Up d'édition (avec la croix)
        $('#' + boutonEditer).parent().find('.ingBase1').text($('select[name="editionIngBase1"]').val());   // On défini les ingrédients de la pizza du panier
        $('#' + boutonEditer).parent().find('.ingBase2').text($('select[name="editionIngBase2"]').val());   // conformément aux choix effectués dans les SELECT
        $('#' + boutonEditer).parent().find('.ingBase3').text($('select[name="editionIngBase3"]').val());   // ...
        $('#' + boutonEditer).parent().find('.ingBase4').text($('select[name="editionIngBase4"]').val());   // ...

        if (($('select[name="editionIngOpt1"]').val() == "" || $('select[name="editionIngOpt1"]').val() == undefined) &&
            ($('select[name="editionIngOpt2"]').val() == "" || $('select[name="editionIngOpt2"]').val() == undefined) &&
            ($('select[name="editionIngOpt3"]').val() == "" || $('select[name="editionIngOpt3"]').val() == undefined) &&
            ($('select[name="editionIngOpt4"]').val() == "" || $('select[name="editionIngOpt4"]').val() == undefined)) {
            console.log("OPTIONS : NON");
            $('#' + boutonEditer).parent().find('.optionsPizza').empty();   // Si en fermant, les options sont vides (== ""), on vide tout dans le texte Option Pizza (tout en gardant la balise <p>)
        }
        else {    // Si en fermant il y a des options
            console.log("OPTIONS : OUI");
            idElement = boutonEditer.slice(-1); // On récupère l'ID de la pizza en récupèrant l'ID du bouton "Editer"
            console.log($('#' + boutonEditer).parent().find('.optionsPizza'));

            if ($('#' + boutonEditer).parent().find('.optionsPizza').children().length > 0) {   // Si Options Pizza a des enfants (donc au moins une option)
                if ($('select[name="editionIngOpt1"]').val() != undefined) {
                    $('#' + boutonEditer).parent().find('.ingOpt1').text($('select[name="editionIngOpt1"]').val().replace('null', ''));
                }
                if ($('select[name="editionIngOpt2"]').val() != undefined) {
                    $('#' + boutonEditer).parent().find('.ingOpt2').text($('select[name="editionIngOpt2"]').val().replace('null', ''));
                }
                if ($('select[name="editionIngOpt3"]').val() != undefined) {
                    $('#' + boutonEditer).parent().find('.ingOpt3').text($('select[name="editionIngOpt3"]').val().replace('null', ''));
                }
                if ($('select[name="editionIngOpt4"]').val() != undefined) {
                    $('#' + boutonEditer).parent().find('.ingOpt4').text($('select[name="editionIngOpt4"]').val().replace('null', ''));
                }
            } else {    // Sinon, elle n'a pas d'options, on les rajoute
                $('#' + boutonEditer).parent().find('.optionsPizza').append("Options :");
                if ($('select[name="editionIngOpt1"]').val() != undefined) {
                    $('#' + boutonEditer).parent().find('.optionsPizza').append("<span class='ingOpt1' id='panierIngOpt1_pizza_" + idElement + "'>" + $('select[name="editionIngOpt1"]').val().replace('null', '') + "</span> ");
                } else {
                    $('#' + boutonEditer).parent().find('.optionsPizza').append("<span class='ingOpt1' id='panierIngOpt4_pizza_" + idElement + "'></span> ");
                }
                if ($('select[name="editionIngOpt2"]').val() != undefined) {
                    $('#' + boutonEditer).parent().find('.optionsPizza').append("<span class='ingOpt2' id='panierIngOpt2_pizza_" + idElement + "'>" + $('select[name="editionIngOpt2"]').val().replace('null', '') + "</span> ");
                } else {
                    $('#' + boutonEditer).parent().find('.optionsPizza').append("<span class='ingOpt2' id='panierIngOpt2_pizza_" + idElement + "'></span> ");
                }
                if ($('select[name="editionIngOpt3"]').val() != undefined) {
                    $('#' + boutonEditer).parent().find('.optionsPizza').append("<span class='ingOpt3' id='panierIngOpt3_pizza_" + idElement + "'>" + $('select[name="editionIngOpt3"]').val().replace('null', '') + "</span> ");
                } else {
                    $('#' + boutonEditer).parent().find('.optionsPizza').append("<span class='ingOpt3' id='panierIngOpt3_pizza_" + idElement + "'></span> ");
                }
                if ($('select[name="editionIngOpt4"]').val() != undefined) {
                    $('#' + boutonEditer).parent().find('.optionsPizza').append("<span class='ingOpt4' id='panierIngOpt4_pizza_" + idElement + "'>" + $('select[name="editionIngOpt4"]').val().replace('null', '') + "</span> ");
                } else {
                    $('#' + boutonEditer).parent().find('.optionsPizza').append("<span class='ingOpt4' id='panierIngOpt4_pizza_" + idElement + "'></span> ");
                }
            }
        }
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
            taillePizza: $('select[name="taille"]').val(),
            pizza: []
        };
        let verifierPizzaNom, verifierPizzaQuantite;

        let nom, prenom, tel, adresse, codePostal, ville; // infos client
        let modeCommande, typeBoite; // infos commande

        modeCommande = 'modeCommande=' + $(".modeCommande").children('input[name="modeCommande"]:checked').val().trim();
        typeBoite = 'typeBoite=' + $(".boitePizza").children('input[name="typeBoite"]:checked').val().trim();

        $(".listePanier > div").each(function () {  // Pour toutes les sélections du panier
            if (parseInt($(this).find('.quantitePizza').text()) > 0) {
                let pizzaSelection = $(this).find('.nomPizza').text() + ",";
                let pizzaSelectionQuantite = $(this).find('.quantitePizza').text() + ",";
                let ingBase1_commande = $(this).find('.ingBase1').text() + ",";
                let ingBase2_commande = $(this).find('.ingBase2').text() + ",";
                let ingBase3_commande = $(this).find('.ingBase3').text() + ",";
                let ingBase4_commande = $(this).find('.ingBase4').text() + ",";

                let ingOpt1_commande, ingOpt2_commande, ingOpt3_commande, ingOpt4_commande;
                if ($(this).find('.ingOpt1').text() != undefined || $(this).find('.ingOpt1').text() != "") {
                    ingOpt1_commande = $(this).find('.ingOpt1').text() + ",";
                } else {
                    ingOpt1_commande = ",";
                }
                if ($(this).find('.ingOpt2').text() != undefined || $(this).find('.ingOpt2').text() != "") {
                    ingOpt2_commande = $(this).find('.ingOpt2').text() + ",";
                } else {
                    ingOpt2_commande = ",";
                }
                if ($(this).find('.ingOpt3').text() != undefined || $(this).find('.ingOpt3').text() != "") {
                    ingOpt3_commande = $(this).find('.ingOpt3').text() + ",";
                } else {
                    ingOpt3_commande = ",";
                }
                if ($(this).find('.ingOpt4').text() != undefined || $(this).find('.ingOpt4').text() != "") {
                    ingOpt4_commande = $(this).find('.ingOpt4').text() + ",";
                } else {
                    ingOpt4_commande = ",";
                }

                let unePizza = {
                    nomPizza: pizzaSelection,
                    quantitePizza: pizzaSelectionQuantite,
                    ingBase1: ingBase1_commande,
                    ingBase2: ingBase2_commande,
                    ingBase3: ingBase3_commande,
                    ingBase4: ingBase4_commande,
                    ingOpt1: ingOpt1_commande,
                    ingOpt2: ingOpt2_commande,
                    ingOpt3: ingOpt3_commande,
                    ingOpt4: ingOpt4_commande
                };

                pizzaCommande['pizza'].push(unePizza);  // On ajoute les pizzas au JSON
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
            verifierTaille = "verifTaille=" + pizzaCommande.taillePizza; // Taille == L ou Taille == XL
            verifierIngBase1 = "ingBase1=" + pizzaCommande.pizza[0].ingBase1;   // On voudra vérifier la présence d'au moins un ingrédient valide
            verifierIngBase2 = "ingBase2=" + pizzaCommande.pizza[0].ingBase2;   // ...
            verifierIngBase3 = "ingBase3=" + pizzaCommande.pizza[0].ingBase3;   // + Controller la validité des ingrédients
            verifierIngBase4 = "ingBase4=" + pizzaCommande.pizza[0].ingBase4;   // ...
            verifierIngOpt1 = "ingOpt1=" + pizzaCommande.pizza[0].ingOpt1;    // + Controller la validité des options
            verifierIngOpt2 = "ingOpt2=" + pizzaCommande.pizza[0].ingOpt2;    // ...
            verifierIngOpt3 = "ingOpt3=" + pizzaCommande.pizza[0].ingOpt3;    // ...
            verifierIngOpt4 = "ingOpt4=" + pizzaCommande.pizza[0].ingOpt4;    // ...
        } catch (error) {
            console.log("%cPas de pizza sélectionnée\nImpossible de passer la commande", "color:salmon");
        }

        var lienAPI = 'http://localhost/Pizzip/controller/client/enregistrerCommande.php';
        var parametres = nom + '&' + prenom + '&' + modeCommande + '&' + typeBoite + '&' + tel + '&' + adresse + '&' + codePostal + '&' + ville + '&' +
            verifierPizzaNom + '&' + verifierPizzaQuantite + '&' + verifierIngBase1 + '&' + verifierIngBase2 + '&' + verifierIngBase3 + '&' + verifierIngBase4 +
            '&' + verifierIngOpt1 + '&' + verifierIngOpt2 + '&' + verifierIngOpt3 + '&' + verifierIngOpt4 + '&' + verifierTaille;
        console.log("Requete : " + lienAPI + '?' + parametres);

        $.getJSON(lienAPI + '?' + parametres).done(function (result) { // Requete AJAX - Save + Check des données utilisateur
            console.log("%cSuccess - COMMANDE: %c" + result.success, "color:gold", "color:white");
            console.log("%cNuméro de commande: %c" + result.numCom, "color:lightgreen", "color:white");
            pizzaCommande.numCommande = result.numCom;
            if (result.success == true) {   // Si les données utilisateurs ont pu être enregistrées, on peut enregistrer les pizzas
                $.ajax({
                    type: 'POST',
                    url: 'http://localhost/Pizzip/controller/client/enregistrerPizza.php',
                    data: JSON.stringify(pizzaCommande),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function (resultat) {
                        console.log(resultat);
                        if (resultat.success == true) {
                            let url = '../../../view/pages/pages_client/finCommande.php';    // URL - Page de fin de commande

                            adresseComplete = $("input[name='adresse']").val() + ' - ' + $("input[name='ville']").val();  // $_POST['adr']
                            let prixTotal = $('#montantTotal').text();  // $_POST['total']
                            let timeMax = 45;
                            let timeMin = 30;
                            let time = Math.floor(Math.random() * (timeMax - timeMin + 1) + timeMin);   // $_POST['time'] - aléatoire pour le moment
                            let firstname = $("input[name='prenom']").val();  // $_POST['name']
                            let modCom = $(".modeCommande").children('input[name="modeCommande"]:checked').val().trim();
                            var form = $('<form action="' + url + '" method="post" hidden>' +
                                '<input type="text" name="name" value="' + firstname + '" />' +
                                '<input type="text" name="adr" value="' + adresseComplete + '" />' +
                                '<input type="text" name="total" value="' + prixTotal + '" />' +
                                '<input type="text" name="time" value="' + time + '" />' +
                                '<input type="text" name="typeCom" value="' + modCom + '" />' +
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