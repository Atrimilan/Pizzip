setInterval(function () {
      
    $.ajax({
       url: "http://localhost/coursphp/Pizzip/model/scripts/detailcommande.json",

       success: function (data) {

          console.log("JSON  COMMANDE chargé");
          
          var commande = data;

          var limite = commande.length;

          console.log(commande);
          //console.log(limite);
         
          for (var i = 0; i < limite; i++) {

                         
             //var textTD2 = "<p id=test> <br> Quantité : " + commande[i].Quant + "<br><p>";
             var textTD2 = " Quantité : " + commande[i].Quant;
             
             $.post("../../model/scripts/detailPizza.php", {numpiz: commande[i].Num_Detail} );

             //var ligne = document.createElement("tr");
             //ligne.setAttribute("id", "ligne" + commande[i].NumCom);

             
             //var colonne2 = document.createElement("td");
             //document.getElementById("test" + commande[i].NumCom ).innerHTML += textTD2;
             
             if (document.getElementById("ligne" + commande[i].NumCom)) { // Ajoute quand la div n'existe pas
               //if ( $("#vide" + commande[i].NumCom).text() =='' || $("#vide" + commande[i].NumCom).length < 15) {
                document.getElementById("vide" + commande[i].NumCom).innerHTML += textTD2;
                //document.getElementById("tabe").appendChild(ligne);
                //document.getElementById("ligne" + commande[i].NumCom).appendChild(colonne1);
                //document.getElementById("ligne" + commande[i].NumCom).appendChild(colonne2);
                //document.getElementById("ligne" + commande[i].NumCom).appendChild(colonne3);
               //}
             }
             
          }

       }
    });
 }, 3000);