<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Piz.zip - Commande</title>
	<script src="https://code.jquery.com/jquery-latest.js"></script> <!-- Dernier Jquery -->
	<link href="../../model/style/pages_style.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="http://localhost/CNAM/Pizzip/model/images/pizzipLogo.png">
</head>

<body>
	<div class="wrapper">
		<div class=commande>

			<div class="titreAccueil" id="premierTitreAccueil">
				<p>Mode de commande</p>
			</div>
			<div class="modeCommande">
				<!-- Mode de la commande (Livraison / A emporter) -->
				<input type="radio" id="modeLivraison" name="modeCommande" value="livraison" checked>
				<label for="modeLivraison">Livraison</label>
				<input type="radio" id="modeAEmporter" name="modeCommande" value="aEmporter">
				<label for="modeAEmporter">A emporter</label>
			</div>

			<div class="offrePizza">
				<div id="offreLivraison">
					<p>Livraison offerte à partir de 2 pizzas achetées !</p>
				</div>
				<div id="offreAEmporter" hidden>
					<p>A emporter ? La 6ème pizza est offerte !</p>
				</div>
			</div>

			<div class="titreAccueil">
				<p>Vos informations client</p>
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

			<div class="titreAccueil">
				<p>Choisissez vos pizzas</p>
			</div>
			<div class='listePizza'>
				<!-- Liste des pizzas -->
				<?php
				require_once("../../controller/connexion.php");

				try {
					$result = $pdo->query("SELECT * FROM PIZZA");    // Requete PDO pour afficher les pizzas

					while ($tabPizza = $result->fetch(PDO::FETCH_ASSOC)) {
						echo "<div class='blockPizza'>";
						echo 	"<div class='divPizza' id='pizza_" . $tabPizza['IdPizza'] . "' >";
						echo 		"<p>Pizza : <span class='nomPizza' id='nomPizza_" . $tabPizza['IdPizza'] . "'>" . $tabPizza['NomPizza'] . "</span></p>";
						echo 		"<p>Taille : <span class='taillePizza' id='taillePizza_" . $tabPizza['IdPizza'] . "'>" . $tabPizza['Taille'] . "</p>";
						echo 		"<p>Ingrédients : <span class='ingBase1' id='ingBase1_" . $tabPizza['IdPizza'] . "'>" . $tabPizza['IngBase1'] . "</p>";
						echo 		"<p>Prix : <span class='prixPizza' id='prixPizza_" . $tabPizza['IdPizza'] . "'>" . $tabPizza['PrixUHT'] . "</span> €</p>";
						echo 	"</div>";
						echo 		"<input type='button' class='ajouterPizza' id='incrementQuantite_" . $tabPizza['IdPizza'] . "' value='Ajouter'>";
						echo "</div>";
					}
				} catch (PDOException $e) {
					print $e->getMessage();
				}
				?>
			</div>

			<div class="titreAccueil">
				<p>Personnalisez votre commande</p>
			</div>

			<div class="boitePizza">
				<!-- Type de boîte (Carton - 0€ / Isotherme - 2€) -->
				<input type="radio" id="boiteCarton" name="typeBoite" value="carton" checked>
				<label for="boiteCarton">Boîte en carton - 0€</label>
				<input type="radio" id="boiteIsotherme" name="typeBoite" value="isotherme">
				<label for="boiteIsotherme">Sac isotherme - 3€</label>
			</div>

			<div class="taillePizza">
				<p id="texteTaillePizza">Taille de votre commande :</p>
				<!-- Taille de la pizza -->
				<select name="taille" id="taillePizzaSelect">
					<option value="L" selected>Normale</option>
					<option value="XL">Grande</option>
				</select>
			</div>

			<div class="editionPopUp">
				<div class="editionContainer">
					<h2>Edition des ingrédients</h2>
					<a class="fermerModifierPizza" href="javascript:void(0)">X</a><br><br>
				</div>
				<div class="contourNoir"></div>
			</div>
		</div>
		<div class="fondPanier"></div>
		<div class=panier>
			<div class="headerPanier">
				<div class="titrePanier">
					<h1>Mon Panier</h1>
				</div>
				<div class="montantCommande">
					<!-- Affichage du prix -->
					<h3 class="montantCommande">Total : <span id="montantTotal">0</span> €</h3>
				</div>
				<div class="separationPanier"></div>
			</div>


			<div class="footerPanier">
				<button id="validerCommande" type="button">Valider la commande !</button>
			</div>

			<div class="espaceTopPanier"></div>
			<div class="listePanier"></div>
			<div class="espaceBottomPanier"></div>
		</div>
	</div>

	<script type="text/javascript" src="../../model/scripts/priseDeCommande.js"></script>
</body>

</html>