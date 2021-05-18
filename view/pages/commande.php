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
					echo 		"<input type='button' class='ajusterQuantite' id='incrementQuantite_" . $tabPizza['IdPizza'] . "' value='+'>";
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

	<script type="text/javascript" src="../../model/scripts/priseDeCommande.js"></script>
</body>

</html>