<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Piz.zip - Merci !</title>
    <script src="https://code.jquery.com/jquery-latest.js"></script> <!-- Dernier Jquery -->
    <link href="../../model/style/pages_style.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="http://localhost/CNAM/Pizzip/model/images/pizzipLogo.png">
</head>

<body>
    <div class="finCommandeContainer">
        <div id="remerciement">
            <p>Merci pour votre commande <span id='nom'></span> !</p>
        </div>
        <div id="informations">
            <p>Elle arrivera dans <span id='time'>45</span> minutes, à l'adresse : <span id='adr'></span></p>
            <p>Vous avez dépensé <span id='total'>45</span> € aujourd'hui !</p>
        </div>
        <a href="../pages/commande.php" class="lien">Retour au menu</a>

    </div>
    <img id="logoFinCommande" src="http://localhost/CNAM/Pizzip/model/images/pizzipLogo.png" alt="LogoPizzip">
</body>

</html>

<script>
    <?php
    if (!isset($_POST['name']) || !isset($_POST['adr']) || !isset($_POST['total']) || !isset($_POST['time'])) {
        header('Location: http://localhost/CNAM/Pizzip/view/');
    }
    ?>
    let doc = document;
    $(doc).ready(function() {

        var getJsonData = {
            infos: <?php
                    echo json_encode(
                        [
                            'name' => $_POST['name'],
                            'adr' => $_POST['adr'],
                            'total' => $_POST['total'],
                            'time' => $_POST['time']
                        ]
                    )
                    ?>,
        };
        console.log(getJsonData['infos']);

        $('#nom').text(getJsonData['infos'].name);
        $('#adr').text(getJsonData['infos'].adr);
        $('#total').text(getJsonData['infos'].total);
        $('#time').text(getJsonData['infos'].time);
    });
</script>