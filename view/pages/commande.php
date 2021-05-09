<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Piz.zip - Commande</title>
	<script src="https://code.jquery.com/jquery-latest.js"></script> <!-- Dernier Jquery -->
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
			<input type="text" value="nom" placeholder="Nom">
			<input type="text" value="prenom" placeholder="Prénom">
			<input type="text" value="telephone" placeholder="Téléphone">
			<input type="text" value="adresse" placeholder="Adresse">
			<input type="text" value="codePostal" placeholder="Code Postal">
			<input type="text" value="complementAdresse" placeholder="Complément d'adresse">
		</div>

		<div class='listePizza'>
			<!-- Liste des pizzas -->
			<?php
			require_once("../../controller/connexion.php");

			try {
				$result = $pdo->query("SELECT * FROM PIZZA");    // Requete PDO

				while ($tabPizza = $result->fetch(PDO::FETCH_ASSOC)) {
					echo "<div class='blockPizza'>";
					echo "<div class='divPizza' id='pizza_" . $tabPizza['IdPizza'] . "' >";
					echo "Pizza : " . $tabPizza['NomPizza'] . "<br>";
					echo "Taille : " . $tabPizza['Taille'] . "<br>";
					echo "Ingrédients : " . $tabPizza['IngBase1'];
					echo "</div>";

					echo "<div class='divQuantite'>";
					echo "Quantité : <span id='quantitePizza_" . $tabPizza['IdPizza'] . "'>0</span> ";
					echo "<input type='button' class='ajusterQuantite' id='incrementQuantite_" . $tabPizza['IdPizza'] . "' value='+'> ";
					echo "<input type='button' class='ajusterQuantite' id='decrementQuantite_" . $tabPizza['IdPizza'] . "' value='-'>";
					echo "</div>";
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
			<input type="radio" id="boiteIsotherme" name="typeBoite" value="isotheme">
			<label for="boiteIsotherme">Boîte isotherme - 2€</label>
		</div>

		<button>Valider</button>

	</form>

	<script type="text/javascript">
		var doc = document;

		$(doc).ready(function() {

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
						if ($(this).val() != "nom" && $(this).val() != "prenom") {
							$(this).hide();
						}
					});
				}
			});

			$('.ajusterQuantite').click(function(event) {
				var selectedButton = event.target.id;
				if ($('#' + selectedButton).val() == "+") {
					var spanQuantite = $('#' + selectedButton).parent().find("span");
					spanQuantite.text(parseInt(spanQuantite.text()) + 1);

					var selectedPizza = $('#' + selectedButton).parent().parent().children(".divPizza");
				} else {
					var spanQuantite = $('#' + selectedButton).parent().find("span");
					if (parseInt(spanQuantite.text()) != 0) {
						spanQuantite.text(parseInt(spanQuantite.text()) - 1);
					}
				}

				verifierSelections(selectedButton, spanQuantite);
			});

			function verifierSelections(selectedButton, spanQuantite) {
				var selectedPizza = $('#' + selectedButton).parent().parent().children(".divPizza");
				if (parseInt(spanQuantite.text()) > 0) {
					selectedPizza.css("background-color", "rgb(120, 255, 200)");
				} else {
					selectedPizza.css("background-color", "rgb(255, 255, 255)");
				}
			}
		});
	</script>
</body>

</html>