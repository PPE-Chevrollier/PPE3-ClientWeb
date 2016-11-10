/* JavaScript 
 * Copyright (c) 2016 F. de Robien
*/
$(document).ready(function() {
    jsRecupInfos();
});

$('#buttonFiltrer').click(function(){
  $('#filtre').toggle();
});

function jsRecupInfos(){

        //APPEL du fichier de traitement (ici : tt_ListeCommentaires.php) qui va récupérer les données et les renvoyer en JSON à cette page
        var filterDataRequest = $.ajax({
            url: '../controleur/tt_Trie.php',
            dataType: 'json'
        });
        
        var stringAnneeSortie = '<select name="anneeSortie" id="anneeSortie"><option value="-1">---</option>';
        var stringEditeur = '<select name="editeur" id="editeur"><option value="-1">---</option>';

	//une fois réceptionné les donnees en JSON
	filterDataRequest.done(function(data) {
            $('#genres').text(""); //remise à blanc de la div
            //alert("SUCCES : " + data);
            /*Pour afficher le tableau des commentaires retournés en JSON par la requête AJAX*/
             $.each(data[0], function(index, value) {
                $('#genres').append('<input type="checkbox" value="'+value["IDGENRE"]+'"/>'+value["LIBELLE"]);
            });
            
            // ----
                
            $('#anneeSortie').text(""); //remise à blanc de la div
            //alert("SUCCES : " + data);
            /*Pour afficher le tableau des commentaires retournés en JSON par la requête AJAX*/
             $.each(data[1], function(index, value) {
                stringAnneeSortie+= '<option value="'+value["ANNEESORTIE"]+'">'+value["ANNEESORTIE"]+'</option>';
             });
             
             $('#anneeSortie').append(stringAnneeSortie+'</select>');
             
             // ----
             
             $('#editeur').text(""); //remise à blanc de la div
            //alert("SUCCES : " + data);
            /*Pour afficher le tableau des commentaires retournés en JSON par la requête AJAX*/
             $.each(data[2], function(index, value) {
                stringEditeur+= '<option value="'+value["EDITEUR"]+'">'+value["EDITEUR"]+'</option>';
             });
             
             $('#editeur').append(stringEditeur+'</select>');
             
             jsClickFiltrer();
             
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
};

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
        
        var colone = $("#colone option:selected").attr('value');        
        var sens = $("input[type='radio']:checked").attr('value');
        
        var annee = $("#anneeSortie option:selected").attr('value');
        var editeur = $("#editeur option:selected").attr('value');
        
        //APPEL du fichier de traitement (ici : tt_ListeCommentaires.php) qui va récupérer les données et les renvoyer en JSON à cette page
        var filterDataRequest = $.ajax({
            url: '../controleur/tt_Filtrer.php',
            type: 'GET',
            data: getD+'&colone='+colone+'&sens='+sens+'&annee='+annee+'&editeur='+editeur, // on envoie le numero du jeu, on le testera avec $_GET['idJV']
            dataType: 'json'
        });

	//une fois réceptionné les donnees en JSON
	filterDataRequest.done(function(data) {
            $('#tabJV').text(""); //remise à blanc de la div
            //alert("SUCCES : " + data);
            var isData = false;
            $('#tabJV').append('<tr><th>Nom du jeu</th><th>ann&eacute;e de sortie</th><th>&eacute;diteur</th><th>genre(s)</th><th>note moyenne</th></tr>');
            /*Pour afficher le tableau des commentaires retournés en JSON par la requête AJAX*/
             $.each(data, function(index, value) {
                            $('#tabJV').append('<tr><td>'+value["NOMJV"]+'</td><td>'+value["ANNEESORTIE"]+'</td><td>'+value["EDITEUR"]+'</td><td>'+value["GENRE"]+'</td><td>'+value["NOTE"]+'</td><td><input type="radio" onclick="jsClickRadioButton();" name="nomidjv"  id="'+value["IDJV"]+'"  value="'+value["IDJV"]+'" /></td></tr>');
                            isData = true;
                            });
             if (!isData) $('#tabJV').append('<tr><td colspan="5">Aucunes données</td></tr>');
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