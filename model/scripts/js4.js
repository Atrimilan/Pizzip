

    var espaceNombre = document.getElementById("espace_nombre");

    var xhr = new XMLHttpRequest();

    var url = "";
    //var urlGlobal = "http://localhost/coursphp/Pizzip/controller/changer_etat_commande.php";
    var urlGlobal = "http://localhost/coursphp/Pizzip/controller/donnees.json";

    

    

function buttonClickGetALL() {
    url = urlGlobal;
    buttonClickGet();
}


function buttonClickGet() {
    
    xhr.onreadystatechange = function () {
        console.log(this);
        if (this.readyState == 4 && this.status == 200) {
            alert("chargement effectué ");
            console.log("API  chargé");
            alert(url);

            var commande = this.response;
            var limite = commande.length;
            console.log(commande);
            console.log(limite);
            for (var i = 0; i < limite; i++) {

                
                var textTD1 = commande[i].NumCom;
                var textTD2 = "<td>" + commande[i].NomClient + "<br> ID : " + commande[i].id_commande + "</td><br>"

                var ligne = document.createElement("tr");
                ligne.setAttribute("id", "ligne" + [i]);
                var colonne1 = document.createElement("td");
                colonne1.innerHTML = textTD1;
                var colonne2 = document.createElement("td");
                colonne2.innerHTML = textTD2;

                document.getElementById("tabe").appendChild(ligne);
                document.getElementById("ligne" + [i]).appendChild(colonne1);
                document.getElementById("ligne" + [i]).appendChild(colonne2);
            
            }
            
            espaceNombre.innerHTML += limite;
        }

        else if (this.readyState == 4 && this.status == 404) {
            alert("Erreur 404");
        }
    }
    
    xhr.open("GET", url, true);
    xhr.responseType = "json";
    xhr.send();
}


