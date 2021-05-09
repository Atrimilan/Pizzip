
$(document).ready(function () {
    
    function Dossier() {
         	var fso=new ActiveXObject("Scripting.FileSystemObject");
        alert(fso.FolderExists("dossierOF"));
        let monDossier;
        monDossier = monDossier.getFolder("dossierOF");
        index = new Enumerator(monDossier.files);
        for (; !index.atEnd(); monDossier.moveNext()){
            alert(monDossier.item());
        }
    }
    function afficher(){
        $("tbody").append("<tr></tr>");
        $("tbody").children().last().load("dossierOF/commande.txt");
    }
    $("#rafraichir").click(function () {
        afficher()
        //setInterval("console.log('tata')", 5000); 
        Dossier();
    });
});
