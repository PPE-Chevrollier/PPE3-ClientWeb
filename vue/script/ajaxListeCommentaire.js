/* JavaScript 
 * Copyright (c) 2016 F. de Robien
*/
$(document).ready(function() {
	jsChargementCommentaires();
	(document.getElementById('infoERREUR')).style.display = "none"; //pour la mettre en affichage
});

	
function jsChargementCommentaires(){	
		(document.getElementById('infoERREUR')).style.display = ""; //pour la mettre en affichage
		console.log("ready!");

  	
		//APPEL du fichier de traitement (ici : tt_ListeCommentaires.php) qui va récupérer les données et les renvoyer en JSON à cette page
		var filterDataRequest = $.ajax({
			url: '../controleur/tt_ListeCommentaires.php',
			type: 'GET',
			dataType: 'json'
		});
  
		
		//une fois les donnees réceptionnées en JSON
		filterDataRequest.done(function(data) {
			//alert("SUCCES : " + data);
			console.log("success");	console.log(data);
			/*Pour afficher le tableau des commentaires retournés en JSON par la requête AJAX*/
			$('#tabCommentaires').text(""); //VIDE TOUS LES COMMENTAIRES EXISTANTS
			
			/*CHARGEMENT des COMMENTAIRES*/
			$('#tabCommentaires').append('<tr><th>Commentaire</th></tr>');
			 $.each(data, function(index, value) {
				 $('#tabCommentaires').append('<tr><td>'+value+'</td><td><input type="radio" onclick="jsClickRadioButton();" name="idComm"  id="'+ index+'"  value="'+ index+'"/></td></tr>');
			 		});	
		});
		filterDataRequest.fail(function(jqXHR, textStatus) {
				//alert("ERROR, jqXHR : "+ jqXHR.responseText + "textStatus : "+ textStatus );
				console.log( "error" );
				if (jqXHR.status === 0){alert("Not connect.n Verify Network.");}
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
		
		
		filterDataRequest.always(function(data) {
			console.log("complete");
		});
}




