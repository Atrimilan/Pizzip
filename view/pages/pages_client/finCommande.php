<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Piz.zip - Merci !</title>
    <script src="https://code.jquery.com/jquery-latest.js"></script> <!-- Dernier Jquery -->
    <link href="../../../model/style/style_client.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="../../../model/images/pizzipLogo.png">
</head>

<body>
    <div class="finCommandeContainer">
        <div id="remerciement">
            <p>Merci pour votre commande <span id='nom'></span> !</p>
        </div>
        <div id="informations">
            <p id="informationsLivraison">Elle arrivera dans <span id='time'>45</span> minutes, à l'adresse : <span id='adr'></span></p>
            <p>Vous avez dépensé <span id='total'>45</span> € aujourd'hui !</p>
        </div>
        <a href="../../.." class="lien">Retour à l'accueil</a>

    </div>
    <img id="logoFinCommande" src="../../../model/images/pizzipLogo.png" alt="LogoPizzip">
</body>

</html>

<script>
    <?php
    if (!isset($_POST['name']) || !isset($_POST['adr']) || !isset($_POST['total']) || !isset($_POST['time'])) {
        header('Location: ../../..');  // Retourner à l'accueil si les infos ne sont pas reçues en POST
    }
    ?>
    let doc = document;
    $(doc).ready(function() {

        var getJsonData = { // Récupérer les données POST dans un JSON
            infos: <?php
                    echo json_encode(
                        [
                            'name' => $_POST['name'],
                            'adr' => $_POST['adr'],
                            'total' => $_POST['total'],
                            'time' => $_POST['time'],
                            'typeCom' => $_POST['typeCom']
                        ]
                    )
                    ?>,
        };
        console.log(getJsonData['infos']);

        $('#nom').text(getJsonData['infos'].name);  // Remplir les span
        $('#adr').text(getJsonData['infos'].adr);
        $('#total').text(getJsonData['infos'].total);
        $('#time').text(getJsonData['infos'].time);

        if (getJsonData['infos'].typeCom != "livraison") {  // Si le mode n'est pas Livraison
            $("#informationsLivraison").hide(); // alors on n'affiche pas d'infos sur la livraison
        }
    });
</script>