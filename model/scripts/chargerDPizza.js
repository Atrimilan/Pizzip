setInterval(function () {
      
    $.ajax({
       url: "http://localhost/coursphp/Pizzip/controller/detailpizza.json",

       success: function (data) {

          console.log("JSON  PIZZA chargé");
          
          var commande = data;

          var limite = commande.length;

          console.log(commande);
          //console.log(limite);

          for (var i = 0; i < limite; i++) {

                         
             var textTD1 = commande[i].NumCom;
             var textTD2 = "<td>" + commande[i].NomClient + "<br> Adresse : " + adresseClient + "<br> Telephone : " +commande[i].TelClient + "<br> Emballage : " + commande[i].TypeEmbal +".zip" + "<br> Etat : " + commande[i].Etat + "" + "</td><br>"
             
             //$.post("../../model/scripts/detailCommande.php", {numcom: commande[i].NumCom});
             //$.post("../../model/scripts/detailPizza.php", {numpiz: commande[i].NumCom});

             var ligne = document.createElement("tr");
             ligne.setAttribute("id", "ligne" + commande[i].NumCom);

             
             //var colonne2 = document.createElement("td");
             colonne2.innerHTML += textTD2;
             
             if (!document.getElementById("ligne" + commande[i].NumCom)) { // Ajoute quand la div n'existe pas

                document.getElementById("tabe").appendChild(ligne);
                document.getElementById("ligne" + commande[i].NumCom).appendChild(colonne1);
                document.getElementById("ligne" + commande[i].NumCom).appendChild(colonne2);
                document.getElementById("ligne" + commande[i].NumCom).appendChild(colonne3);

             }
             
          }

       }
    });
 }, 3000);