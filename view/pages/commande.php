<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Piz.zip - Commande</title>
	<script src="https://code.jquery.com/jquery-latest.js"></script> <!-- Dernier Jquery -->
	<link href="../../model/style/pages_style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<form>
		<div class="modeCommande"></div>
		<div class="infosClient"></div>
		<div class='listePizza'>
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
	</form>
	<script type="text/javascript">
		var doc = document;
		var currentColor;
		var selectedPizza;

		$(doc).ready(function() {
			$('.divPizza').click(function(event) {
				selectedPizza = event.target.id;
				if ($('#' + selectedPizza).css('background-color') == "rgb(250, 216, 127)") {
					$('#' + selectedPizza).css("background-color", "rgb(250, 250, 250)");
				} else {
					$('#' + selectedPizza).css("background-color", "rgb(250, 216, 127)");
				}
			});

			$('.ajusterQuantite').click(function(event) {
				selectedButton = event.target.id;
				if ($('#' + selectedButton).val() == "+") {
					var spanQuantite = $('#' + selectedButton).parent().find("span");
					spanQuantite.text( parseInt(spanQuantite.text()) + 1 );
				} else {
					var spanQuantite = $('#' + selectedButton).parent().find("span");
					spanQuantite.text( parseInt(spanQuantite.text()) - 1 );
				}
			});
		});
	</script>
</body>

</html>