<html>

<head>
    <title>Connexion Espace staff</title>
    <link rel="shortcut icon" href="../../model/images/pizzipLogo.png">
    <meta name="author" content="Flordin Lountala">
    <meta name="description" content="Accès personnel">
    <meta charset="UTF-8" />

    <script src="https://code.jquery.com/jquery-latest.js"> </script> <!-- Dernier Jquery -->
    <link rel="stylesheet" href="../../model/style/Style_login.css" media="screen" type="text/css" />
</head>

<body>
    <div id="container">
        <!-- zone de connexion -->

    <div id="test">
        <center>
            <a href="">
                <img src="../../model/images/pizzipLogo.png" width="150">
            </a>
        </center>

        <p> Type d'accès : </p>
        <select name="espaceLogin" id="idlogin">
            <option value="Livreur" selected>LIVREUR</option>
            <option value="Cuisinier">CUISINIER</option>
            <option value="Admin">ADMIN</option>
        </select>

        <p> Mot de passe : <input type="password" name="espaceMDP" required> </p>

        <input id="bouton_co" type="button" name="bouton_Connecter" value="SE CONNECTER">
    </div>
    </div>

</body>

<script>

    $('#bouton_co').click(function() {
        option = $('select[name="espaceLogin"]').val();

        if (option == "Admin") {
            document.location.href="../pages/ihm_.php";//renvoyer sur admin
        } else if (option == "Livreur") {
            document.location.href="../pages/ihm_livreur.php"; //renvoyer sur livreur

        } else if (option == "Cuisinier") {
            document.location.href="../pages/ihm_.php"; //renvoyer sur cuisinier

        }
    });

</script>

</html>