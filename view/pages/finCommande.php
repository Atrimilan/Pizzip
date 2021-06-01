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
            <p>Vous avez dépensé <span id='total'>45</span> € aujourd'hui</p>
            <p>Elle arrivera dans <span id='time'>45</span> minutes, à l'adresse : <span id='adr'></span></p>
        </div>
        <a href="../pages/commande.php" id="lien">Retour au menu</a>

    </div>
    <img id="logoFinCommande" src="http://localhost/CNAM/Pizzip/model/images/pizzipLogo.png" alt="LogoPizzip">
</body>

</html>

<script>
    let doc = document;
    $(doc).ready(function() {
        var getJsonData =
            <?php
            if (isset($_GET['name']) && isset($_GET['adr']) && isset($_GET['total']) && isset($_GET['time'])) {
                $name = $_GET['name'];
                $adr = $_GET['adr'];
                $total = $_GET['total'];
                $time = $_GET['time'];

                echo json_encode(['name' => $name, 'adr' => $adr, 'total' => $total, 'time' => $time]);
            } /*else {
                header('Location: http://localhost/CNAM/Pizzip/view/');
            }*/
            ?>;
        $('#nom').text(getJsonData.name);
        $('#adr').text(getJsonData.adr);
        $('#total').text(getJsonData.total);
        $('#time').text(getJsonData.time);
    });
</script>