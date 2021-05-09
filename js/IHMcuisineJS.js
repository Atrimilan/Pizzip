
$(document).ready(function () {
    $("#rafraichir").click(function () {
        $("tbody").load("dossierOF/commande.txt");
    });
});
