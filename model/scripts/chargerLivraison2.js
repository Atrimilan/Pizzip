$(document).ready(function () {
   setInterval(function () {

      $.ajax({
         url: "http://localhost/coursphp/Pizzip/controller/livraison.json",
         //url: "http://localhost/coursphp/Pizzip/controller/action_chargerCommandeLivraison.php",

         success: function (data) {
            //console.log(data);
            console.log("Actualisé");

            //alert("chargement effectué ");
            console.log("JSON  chargé");

            var espaceNombre = document.getElementById("espace_nombre");
            var commande = data;

            //var dataCompareBase = new Array();
            //var dataCompareNew = new Array();


            var limite = commande.length;

            console.log(commande);
            console.log(limite);

            for (var i = 0; i < limite; i++) {

               //var t = 0;
               //while (t < 1) { 
               //dataCompareBase.push(commande[i].NumCom);
               //t++
               //}

               //dataCompareNew.push(commande[i].NumCom);
               //console.log(dataCompareNew+ " / " + dataCompareBase);
               //console.log("Compare base et new : ", JSON.stringify(dataCompareBase) === JSON.stringify(dataCompareNew));

               var textTD1 = commande[i].NumCom;
               var textTD2 = "<td>" + commande[i].NomClient + "<br> Adresse : " + commande[i].AdrClient + " " + commande[i].CP_Client + " " + commande[i].VilClient + "<br> Etat : " + commande[i].Etat + "" + "</td><br>"
               var textTD3 = "<td> <input type=button id=" + commande[i].NumCom + " class=btn1 value=Demarrer Livraison >  <br> Autre <br></td><br>"

               var ligne = document.createElement("tr");
               ligne.setAttribute("id", "ligne" + commande[i].NumCom);
               var colonne1 = document.createElement("td");
               colonne1.innerHTML += textTD1;
               var colonne2 = document.createElement("td");
               colonne2.innerHTML += textTD2;
               var colonne3 = document.createElement("td");
               colonne3.innerHTML += textTD3;

               if (!document.getElementById("ligne" + commande[i].NumCom)) { // Ajoute quand la div n'existe pas

                  document.getElementById("tabe").appendChild(ligne);
                  document.getElementById("ligne" + commande[i].NumCom).appendChild(colonne1);
                  document.getElementById("ligne" + commande[i].NumCom).appendChild(colonne2);
                  document.getElementById("ligne" + commande[i].NumCom).appendChild(colonne3);

               }


               //if(commande =! data){
               //console.log("Different");
               //if(document.getElementById("ligne" + commande[i].NumCom) ){ // Supprime quand la div existe   
               //console.log("Different");
               //document.getElementById("ligne" + commande[i].NumCom).remove();
               //supprimer();
               //}

               //}                    

            }

            espaceNombre.innerHTML = "nombre de commandes à livrer passées : " + limite;
         }
      });
   }, 3000);

   function supprimer() {
      // Supprime tous les enfant d'un élément
      var element = document.getElementById("tabe");
      while (element.firstChild) {
         element.removeChild(element.firstChild);
      }
   }

//        -------- Bouton Demarrer ----------
   $(document).on('click', '.btn1', function (event) {
      //var valeur = event.target.id;
      var valeur = $(this).attr('id');
      $.getJSON("http://localhost/action_changerEtatLivraison.php?id="+valeur).done(function (result) { 
         console.log(result);
      });  
      console.log("Changer etat livraison : " + valeur);
      $('#ligne'+valeur).css("background-color", "green");
   });
//        -------- Bouton ----------


});
