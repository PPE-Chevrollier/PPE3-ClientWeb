/* JavaScript 
 * Copyright (c) 2016 F. de Robien
*/
$(document).ready(function() {        
        //APPEL du fichier de traitement (ici : tt_ListeCommentaires.php) qui va récupérer les données et les renvoyer en JSON à cette page
        var filterDataRequest = $.ajax({
            url: '../controleur/tt_Genre.php',
            dataType: 'json'
        });

	//une fois réceptionné les donnees en JSON
	filterDataRequest.done(function(data) {
            $('#genres').text(""); //remise à blanc de la div
            //alert("SUCCES : " + data);
            /*Pour afficher le tableau des commentaires retournés en JSON par la requête AJAX*/
             $.each(data, function(index, value) {
                $('#genres').append('<input type="checkbox" value="'+value["IDGENRE"]+'"/>'+value["LIBELLE"]);
                });
	});
        
	filterDataRequest.fail(function(jqXHR, textStatus) {
            //alert("ERROR, jqXHR : "+ jqXHR.responseText + "textStatus : "+ textStatus );
            if (jqXHR.status === 0){alert("Not connect.n Verify Network.");}
            else if (jqXHR.status === 404){alert("Requested page not found. [404]");}
            else if (jqXHR.status === 500){alert("Internal Server Error [500].");}
            else if (textStatus === "parsererror"){alert("Requested JSON parse failed.");}
            else if (textStatus === "timeout"){alert("Time out error.");}
            else if (textStatus === "abort"){alert("Ajax request aborted.");}
            else{alert("Uncaught Error.n" + jqXHR.responseText);}
        });
});