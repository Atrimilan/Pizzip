<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Piz.zip - Commande</title>
	<script src="https://code.jquery.com/jquery-latest.js"></script> <!-- Dernier Jquery -->
	<link href="../../model/style/pages_style.css" rel="stylesheet" type="text/css">
	<link href="../../model/style/pages_style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<form id="test">

		<div class="modeCommande">
			<!-- Mode de la commande (Livraison / A emporter) -->
			<input type="radio" id="modeLivraison" name="modeCommande" value="livraison" checked>
			<label for="modeLivraison">Livraison</label>
			<input type="radio" id="modeAEmporter" name="modeCommande" value="aEmporter">
			<label for="modeAEmporter">A emporter</label>
		</div>

		<div class="infosClient">
			<!-- Informations sur le client -->
			<input type="text" name="nom" placeholder="Nom">
			<input type="text" name="prenom" placeholder="Prénom">
			<input type="text" name="telephone" placeholder="Téléphone">
			<input type="text" name="adresse" placeholder="Adresse">
			<input type="text" name="codePostal" placeholder="Code Postal">
			<input type="text" name="ville" placeholder="Ville">
		</div>

		<div class='listePizza'>
			<!-- Liste des pizzas -->
			<?php
			require_once("../../controller/connexion.php");

			try {
				$result = $pdo->query("SELECT * FROM PIZZA");    // Requete PDO

				while ($tabPizza = $result->fetch(PDO::FETCH_ASSOC)) {
					echo "<div class='blockPizza'>";
					echo 	"<div class='divPizza' id='pizza_" . $tabPizza['IdPizza'] . "' >";
					echo 		"<p>Pizza : <span class='nomPizza' id='nomPizza_" . $tabPizza['IdPizza'] . "'>" . $tabPizza['NomPizza'] . "</span></p>";
					echo 		"<p>Taille : " . $tabPizza['Taille'] . "</p>";
					echo 		"<p>Ingrédients : " . $tabPizza['IngBase1'] . "</p>";
					echo 		"<p>Prix : <span class='prixPizza' id='prixPizza_" . $tabPizza['IdPizza'] . "'>" . $tabPizza['PrixUHT'] . "</span> €</p>";
					echo 	"</div>";

					echo 	"<div class='divQuantite'>";
					echo 		"Quantité : <span class='quantitePizza' id='quantitePizza_" . $tabPizza['IdPizza'] . "'>0</span>";
					echo 		"<input type='button' class='ajusterQuantite' id='incrementQuantite_" . $tabPizza['IdPizza'] . "' value='+'> ";
					echo 		"<input type='button' class='ajusterQuantite' id='decrementQuantite_" . $tabPizza['IdPizza'] . "' value='-'>";
					echo 	"</div>";
					echo "</div>";
				}
			} catch (PDOException $e) {
				print $e->getMessage();
			}
			?>
		</div>

		<div class="offrePizza">
			<div id="offreLivraison">
				<p>La livraison est offerte à partir de 2 pizzas achetées.</p>
			</div>
			<div id="offreAEmporter" hidden>
				<p>La 6ème pizza est offerte.</p>
			</div>
		</div>

		<div class="taillePizza">
			<!-- Taille de la pizza (S / M / L) -->
			<select name="taille" id="taillePizzaSelect">
				<option value="S">Petite</option>
				<option value="M" selected>Moyenne</option>
				<option value="L">Grande</option>
			</select>
		</div>


		<div class="boitePizza">
			<!-- Type de boîte (Carton - 0€ / Isotherme - 2€) -->
			<input type="radio" id="boiteCarton" name="typeBoite" value="carton" checked>
			<label for="boiteCarton">Boîte en carton - 0€</label>
			<br>
			<input type="radio" id="boiteIsotherme" name="typeBoite" value="isotherme">
			<label for="boiteIsotherme">Sac isotherme - 3€</label>
		</div>

		<div class="montantCommande">
			<!-- Affichage du prix -->
			<p>Montant total de la commande : <span id="montantTotal">0</span> €</p>
		</div>

		<button id="validerCommande" type="button">Valider</button>

	</form>

	<script type="text/javascript">
		var doc = document;
		var currentBoxMod = "carton";

		$(doc).ready(function() {

			$('input[name=typeBoite]').click(function() {
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

			$('input[name=modeCommande]').click(function() {
				var selectedMod = $("input[name='modeCommande']:checked").val();
				if (selectedMod == "livraison") {
					$('#offreAEmporter').hide();
					$('#offreLivraison').show();
					$(".infosClient > input").each(function() {
						$(this).show();
					});
				} else if (selectedMod == "aEmporter") {
					$('#offreLivraison').hide();
					$('#offreAEmporter').show();
					$(".infosClient > input").each(function() {
						if ($(this).attr('name') != "nom" && $(this).attr('name') != "prenom") {
							$(this).hide();
						}
					});
				}
			});

			$('.ajusterQuantite').click(function(event) {
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

			function verifierSelections(selectedButton, spanQuantite) {
				var selectedPizza = $('#' + selectedButton).parent().parent().children(".divPizza");
				if (parseInt(spanQuantite.text()) > 0) {
					selectedPizza.css("background-color", "rgba(120, 255, 200, 255)");
				} else {
					selectedPizza.css("background-color", "rgba(255, 255, 255, 255)");
				}
			}

			$("#validerCommande").click(function() { // Valider la commande

				var nom, prenom, tel, adresse, codePostal, ville; // infos client
				var modeCommande, typeBoite, pizzaSelection, taillePizza; // infos commande

				modeCommande = 'modeCommande=' + $(".modeCommande").children('input[name="modeCommande"]:checked').val().trim();
				typeBoite = 'typeBoite=' + $(".boitePizza").children('input[name="typeBoite"]:checked').val().trim();


				pizzaSelection = 'pizzaSelection=';
				pizzaSelectionQuantite = 'selectionQuantite=';
				$(".listePizza > div").each(function() {
					if (parseInt($(this).find('.quantitePizza').text()) > 0) {
						pizzaSelection += $(this).find('.nomPizza').text() + ",";
						pizzaSelectionQuantite += $(this).find('.quantitePizza').text() + ",";
					}
				});

				taillePizza = 'taillePizza=' + $('#taillePizzaSelect option:selected').val().trim();

				nom = 'nom=' + $(".infosClient").children('input[name="nom"]').val().trim();
				prenom = 'prenom=' + $(".infosClient").children('input[name="prenom"]').val().trim();

				if (modeCommande == "modeCommande=livraison") {
					// Données utiles seulement dans le cas d'une livraison
					tel = 'tel=' + $(".infosClient").children('input[name="telephone"]').val().trim();
					adresse = 'adresse=' + $(".infosClient").children('input[name="adresse"]').val().trim();
					codePostal = 'codePostal=' + $(".infosClient").children('input[name="codePostal"]').val().trim();
					ville = 'ville=' + $(".infosClient").children('input[name="ville"]').val().trim();
				}

				var lienAPI = 'http://localhost/CNAM/Pizzip/controller/enregistrerCommande.php';
				var parametres = nom + '&' + prenom + '&' + modeCommande + '&' + typeBoite + '&' + tel + '&' + adresse + '&' + codePostal + '&' + ville;
				$.getJSON(lienAPI + '?' + parametres).done(function(result) {

					console.log(result);
					console.log(result.success);

					/*incrementateur = 0;
					for (element in result) {
						switch (incrementateur) {
							case 0:
								list.append("Four n°" + result[element] + ":<br>"); // le premier élement est l'ID, et on ne l'afficher qu'une seule fois
								break;
							case 1:
								list.append("<br>Date : " + result[element] + "<br>"); // afficher la date
								incrementateur++;
								break;
							case 2:
								list.append("Température : " + result[element] + "°C<br>"); // afficher la température
								incrementateur = 1;
						}
					}*/
				});
				console.log("%c- Validation de la commande -", "color:red; font-weight:bold; font-size:15px")
				console.log(nom);
				console.log(prenom);
				if (modeCommande == "modeCommande=livraison") {
					console.log(tel);
					console.log(adresse);
					console.log(codePostal);
					console.log(ville);
				}
				console.log(modeCommande);
				console.log(typeBoite);
				console.log(pizzaSelection);
				console.log(pizzaSelectionQuantite);
				console.log(taillePizza);
			});
		});
	</script>
</body>

</html>