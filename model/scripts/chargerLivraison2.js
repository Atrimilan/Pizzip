$(document).ready(function () {
   
   setInterval(function () {
      
      $.ajax({
         url: "http://localhost/coursphp/Pizzip/controller/livraison.json",

         success: function (data) {
            //console.log(data);
            console.log("Actualisé");

            //alert("chargement effectué ");
            console.log("JSON  chargé");

            var espaceNombre = document.getElementById("espace_nombre");
            var commande = data;

            var limite = commande.length;

            console.log(commande);
            //console.log(limite);

            for (var i = 0; i < limite; i++) {


               var textTD1 = commande[i].NumCom;
               var textTD2 = "<td>" + commande[i].NomClient + "<br> Adresse : " + commande[i].AdrClient + " " + commande[i].CP_Client + " " + commande[i].VilClient + "<br> Telephone : " +commande[i].TelClient + "<br> Emballage : " + commande[i].TypeEmbal +".zip" + "<br> Etat : " + commande[i].Etat + "" + "</td><br>"
               var textTD3 = "<td> <input type=button id=" + commande[i].NumCom + " class=btn1 name=demarrer" + commande[i].NumCom + " value=Demarrer Livraison >  <br> <input type=button id=" + commande[i].NumCom + " class=btn2 name=terminer" + commande[i].NumCom + " value=Terminer Livraison > <br></td><br>"


               var ligne = document.createElement("tr");
               ligne.setAttribute("id", "ligne" + commande[i].NumCom);

               var colonne1 = document.createElement("td");
               colonne1.innerHTML += textTD1;
               var colonne2 = document.createElement("td");
               colonne2.innerHTML += textTD2;
               var colonne3 = document.createElement("td");
               colonne3.innerHTML += textTD3;
               //$('[name=terminer'+commande[i].NumCom+']').hide(); // cacher
               if (!document.getElementById("ligne" + commande[i].NumCom)) { // Ajoute quand la div n'existe pas

                  document.getElementById("tabe").appendChild(ligne);
                  document.getElementById("ligne" + commande[i].NumCom).appendChild(colonne1);
                  document.getElementById("ligne" + commande[i].NumCom).appendChild(colonne2);
                  document.getElementById("ligne" + commande[i].NumCom).appendChild(colonne3);

               }
               

            }

            espaceNombre.innerHTML = "nombre de commandes à livrer passées : " + limite;
         }
      });
   }, 3000);

//        ---------- FONCTION ----------

   function changementEtat(etat, numCom) {
      $.post("../../model/scripts/modifRequete.php", {etat: etat, numCom: numCom});
   }

   function supprimer(numero) {
      // Supprime tous les enfant d'un élément
      var element = document.getElementById("ligne" + numero);
      while (element.firstChild) {
         element.removeChild(element.firstChild);
      }
   }

//        -------- Bouton Demarrer ----------
   $(document).on('click', '.btn1', function (event) {
      //var valeur = event.target.id;
      var valeur = $(this).attr('id');
      var etat = "enLivraison";
      changementEtat(etat,valeur);
      console.log("Commande n° "+ valeur + " passse à l'etat : " + etat);
      $('#ligne'+valeur).css("background-color", "grey");
      $('[name=demarrer'+valeur+']').hide(); // cacher
      $('[name=terminer'+valeur+']').show(); // afficher
   });
//        -------- Bouton ----------

//        -------- Bouton Terminer ----------
$(document).on('click', '.btn2', function (event) {
   var valeur = $(this).attr('id');
   var etat = "livree";
   changementEtat(etat,valeur);
   console.log("Commande n° "+ valeur + " passse à l'etat : " + etat);
   $('#ligne'+valeur).css("background-color", "green");
   supprimer(valeur);
});
//        -------- Bouton ----------

});
