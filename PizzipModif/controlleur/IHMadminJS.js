$(document).ready(function () {
  
  
  interval = setInterval(function () {          
            $.ajax({
                url: "../controlleur/RecupDonner.php",
                datatype: "json",
                success: function (data) {
                   let result = JSON.parse((data))
                    console.log(result);
                    
                    console.log(result[1]["NomIngred"]);
                }
            });
        }, 10000);
})