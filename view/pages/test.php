<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-latest.js"></script> <!-- Dernier Jquery -->
    <link href="../../model/style/pages_style.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="http://localhost/CNAM/Pizzip/model/images/pizzipLogo.png">
    <title>Document</title>
</head>

<body>
    <button id="val">VALIDATION</button>
</body>

</html>

<script>
    let doc = document;

    $(doc).ready(function() {

        $("#val").click(function(event) {
            console.log($("#val").text());
            name = 'Jean-Pierre';
            adr = '12 rue des Brocolis';
            total = '49';
            time = '45';
            var url = 'http://localhost/CNAM/Pizzip/view/pages/finCommande.php';
            var form = $('<form action="' + url + '" method="post">' +
                '<input type="text" name="name" value="' + name + '" />' +
                '<input type="text" name="adr" value="' + adr + '" />' +
                '<input type="text" name="total" value="' + total + '" />' +
                '<input type="text" name="time" value="' + time + '" />' +
                '</form>');
            $('body').append(form);
            form.submit();
        });

    });
</script>