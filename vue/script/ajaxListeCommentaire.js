/* JavaScript 
 * Copyright (c) 2016 F. de Robien
*/
$(document).ready(function() {
	jsChargementCommentaires();
	(document.getElementById('infoERREUR')).style.display = "none"; //pour la mettre en affichage
});

	
function jsChargementCommentaires(){	
    (document.getElementById('infoERREUR')).style.display = ""; //pour la mettre en affichage

    //APPEL du fichier de traitement (ici : tt_ListeCommentaires.php) qui va récupérer les données et les renvoyer en JSON à cette page
    var filterDataRequest = $.ajax({
        url: '../controleur/tt_ListeCommentaires.php',
        type: 'POST',
        dataType: 'json'
    }); 

    //une fois les donnees réceptionnées en JSON
    filterDataRequest.done(function(data) {
        //alert("SUCCES : " + data);
        console.log("success");	console.log(data);
        /*Pour afficher le tableau des commentaires retournés en JSON par la requête AJAX*/
        $('#tabCommentaires').text(""); //VIDE TOUS LES COMMENTAIRES EXISTANTS

        /*CHARGEMENT des COMMENTAIRES*/
        var string = '<tr><th>Commentaire</th><th>Utilisateur</th><th>Refuser</th><th>Accepter</th></tr>';
        var isData = false;
        
        $.each(data, function(index, value) {
            isData = true;
            string+='<tr><td>'+value["LIBELLE"]+'</td><td>'+value["PSEUDO"]+'</td><td><a href="" onclick="jsGestionCommentaire('+value["IDU"]+', '+value["IDJV"]+', 2);return false;"><img id="imgCom" src="image/delete.png" alt="croix ajout"/></a></td><td><a href="" onclick="jsGestionCommentaire('+value["IDU"]+', '+value["IDJV"]+', 1);return false;"><img id="imgCom" src="image/add.png" alt="croix supression"/></a></td></tr>';
        });
        
        if (!isData) string+='<tr><td colspan="4">Aucun commentaire à vérifier</td></tr>';

        $('#tabCommentaires').append(string);
    });

    filterDataRequest.fail(function(jqXHR, textStatus) {
        //alert("ERROR, jqXHR : "+ jqXHR.responseText + "textStatus : "+ textStatus );
        console.log( "error" );
        if (jqXHR.status === 0){alert("Not connect.ng Verify Network.");}
        else if (jqXHR.status == 404){alert("Requested page not found. [404]");}
        else if (jqXHR.status == 500){alert("Internal Server Error [500].");}
        else if (textStatus === "parsererror"){alert("Requested JSON parse failed.");}
        else if (textStatus === "timeout"){alert("Time out error.");}
        else if (textStatus === "abort"){alert("Ajax request aborted.");}
        else{alert("Uncaught Error.n" + jqXHR.responseText);}

        /*changement de la couleur du bouton*/
         document.getElementById('baliseA').className= "no";
         (document.getElementById('infoERREUR')).style.display = ""; //pour la mettre en affichage
         $('#dialog1').text(""); //remise à blanc de la div
         $('#dialog1').append('ERROR').append(jqXHR.status);	
    });		
}




