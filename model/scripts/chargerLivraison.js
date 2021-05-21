//$("#but").click(function () {
   //setInterval(function() {    
   $.ajax({
      //url: "http://localhost/coursphp/Pizzip/controller/livraison.json",
      url: "http://localhost/coursphp/Pizzip/controller/action_chargerCommandeLivraison.php",
      
      success: function (data) {
         //console.log(data);
         console.log("Actualisé");
         
                //alert("chargement effectué ");
                console.log("JSON  chargé");

                var espaceNombre = document.getElementById("espace_nombre");
                var commande = data;
                var limite = commande.length;

                console.log(commande);
                console.log(limite);

                for (var i = 0; i < limite; i++) {
                    
                    var textTD1 = commande[i].NumCom;
                    var textTD2 = "<td>" + commande[i].NomClient + "<br> Adresse : " + commande[i].AdrClient + " " + commande[i].CP_Client + " " + commande[i].VilClient + "<br> Etat : " + commande[i].Etat + "" +  "</td><br>"
                    var textTD3 = "<td> bouton 1 <br> bouton 2 <br> bouton 3 <br> </td><br>"
    
                    var ligne = document.createElement("tr");
                    ligne.setAttribute("id", "ligne" + [i]);
                    var colonne1 = document.createElement("td");
                    colonne1.innerHTML = textTD1;
                    var colonne2 = document.createElement("td");
                    colonne2.innerHTML = textTD2;
                    var colonne3 = document.createElement("td");
                    colonne3.innerHTML = textTD3;
    
                    document.getElementById("tabe").appendChild(ligne);
                    document.getElementById("ligne" + [i]).appendChild(colonne1);
                    document.getElementById("ligne" + [i]).appendChild(colonne2);
                    document.getElementById("ligne" + [i]).appendChild(colonne3);
                
                }
                
                espaceNombre.innerHTML = "nombre de commandes à livrer passées : " + limite;
      }
   });
//}, 100 * 60);
//})
