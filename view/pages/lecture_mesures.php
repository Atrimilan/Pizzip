<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Pizzip - Commande</title>
	<script src="https://code.jquery.com/jquery-latest.js"></script> <!-- Dernier Jquery -->
</head>

<body>
	<div class='listePizza'>
	<?php
	require_once("../../controller/connexion/connexion.php");

	try {
		$result = $pdo->query("SELECT * FROM PIZZA");    // Requete PDO

		while ($tabPizza = $result->fetch(PDO::FETCH_ASSOC)) {
			echo "<div class='divPizza' id='pizza_" . $tabPizza['IdPizza'] . "' >" . $tabPizza['NomPizza'] . " / " . $tabPizza['Taille'] . " / " . $tabPizza['IngBase1'] . "</div>";
			echo "<br>";
		}
	} catch (PDOException $e) {
		print $e->getMessage();
	}
	?>
	</div>
	<script type="text/javascript">
		var doc = document;
		$(doc).ready(function() {
			$('.divPizza').click(function(event) {
				var selectedPizza = event.target.id;
				if ($('#' + selectedPizza).css('background-color') == "rgb(20, 220, 60)") {
					$('#' + selectedPizza).css("background-color", "transparent ");
				} else {
					$('#' + selectedPizza).css("background-color", "rgb(20, 220, 60)");
				}
			});
		});
	</script>
</body>

</html>