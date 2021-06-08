$(document).ready(function() {

    $("#bouttonAjouter").click(function(){
        let ingredient = $('#ajouterIngChamp').val();
        
        $.ajax({
            url:"../pages/Server.php",
            type:"POST",
            data: {
                ing: ingredient
            },
            datatype: "json",
            success : function(result){
               console.log(result);
            }
        })
        $('#ajouterIngChamp').val("");
    })
})