/* JavaScript 
 * Copyright (c) 2016 F. de Robien
*/
function jsClickRadioButton(){
	//alert("click sur un radiobutton");
	var idJeu = 0;
	// lorsque l'on clique sur un bouton d'option en face d'un jeu, on verifie lequel est coche et on recupere son id
	$("input[type='radio']:checked").each(
	          function() {
	        	  idJeu =($(this).attr('id'));
	        	  //alert ("id du jeu selectionné : "+ idJeu);
	         }
	    );
		//APPEL du fichier de traitement (ici : tt_ListeCommentaires.php) qui va récupérer les données et les renvoyer en JSON à cette page
		var filterDataRequest = $.ajax({
			url: '../controleur/tt_ListeCommentaires.php',
			type: 'GET',
			data: 'idJV='+ idJeu, // on envoie le numero du jeu, on le testera avec $_GET['idJV']
			dataType: 'json'
		});

	//une fois réceptionné les donnees en JSON
	filterDataRequest.done(function(data) {
		$('#listeCom').text(""); //remise à blanc de la div
		//alert("SUCCES : " + data);
		console.log("success");
		console.log(data);
		$('#listeCom').append('<h3>Les commentaires du jeu sélectionné sont : </h3><ul>');
		/*Pour afficher le tableau des commentaires retournés en JSON par la requête AJAX*/
		 $.each(data, function(index, value) {
		 		$('#listeCom').append('<li>'+ value +'</li>');
		 		});	
		 $('#listeCom').append('</ul>');
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
}; /*FIN DE LA FONCTION jsClickRadioButton*/
