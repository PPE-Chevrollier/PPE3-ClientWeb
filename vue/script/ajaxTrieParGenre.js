/* JavaScript 
 * Copyright (c) 2016 F. de Robien
*/
$(document).ready(function() {
    jsClickFiltrer();
    $('#buttonFiltrer').click(function(){
      $('#filtre').toggle();
    });
});

function jsClickFiltrer(){
	//alert("click sur un radiobutton");
	var idGenres = [];
	// lorsque l'on clique sur un bouton d'option en face d'un jeu, on verifie lequel est coche et on recupere son id
	$("input[type='checkbox']:checked").each(
            function() {
                    idGenres.push(($(this).attr('value')));
                    //alert ("id du jeu selectionné : "+ idJeu);
           }
        );

        var getD = 'idGenres=-1';

        if (idGenres.length !== 0){
            getD = 'idGenres=';
        
            for (var i=0; i < idGenres.length; i++) {
                getD += idGenres[i];
                if ((idGenres.length-1) !== i) getD+= ','; 
            }
        }
        
        //APPEL du fichier de traitement (ici : tt_ListeCommentaires.php) qui va récupérer les données et les renvoyer en JSON à cette page
        var filterDataRequest = $.ajax({
            url: '../controleur/tt_Filtrer.php',
            type: 'GET',
            data: getD, // on envoie le numero du jeu, on le testera avec $_GET['idJV']
            dataType: 'json'
        });

	//une fois réceptionné les donnees en JSON
	filterDataRequest.done(function(data) {
            $('#tabJV').text(""); //remise à blanc de la div
            //alert("SUCCES : " + data);
            var isData = false;
            $('#tabJV').append('<tr><th>Nom du jeu</th><th>ann&eacute;e de sortie</th><th>&eacute;diteur</th><th>genre(s)</th></tr>');
            /*Pour afficher le tableau des commentaires retournés en JSON par la requête AJAX*/
             $.each(data, function(index, value) {
                            $('#tabJV').append('<tr><td>'+value["NOMJV"]+'</td><td>'+value["ANNEESORTIE"]+'</td><td>'+value["EDITEUR"]+'</td><td>'+value["GENRE"]+'</td><td><input type="radio" onclick="jsClickRadioButton();" name="nomidjv"  id="'+value["IDJV"]+'"  value="'+value["IDJV"]+'" /></td></tr>');
                            isData = true;
                            });
             if (!isData) $('#tabJV').append('<tr><td colspan="4">Aucunes données</td></tr>');
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
