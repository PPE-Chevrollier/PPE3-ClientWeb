/* JavaScript 
 * Copyright (c) 2016 F. de Robien
*/
function jsGestionCommentaire(idU, idJV, validation){
    //alert("click sur un radiobutton");
    console.log("ready!");
    // lorsque l'on clique sur un bouton d'option en face d'un jeu, on verifie lequel est coche et on recupere son id

    //APPEL du fichier de traitement (ici : tt_SupprCommentaire.php) qui va récupérer les données et les renvoyer en JSON à cette page
    var filterDataRequest = $.ajax({
        url: '../controleur/tt_GestionCommentaire.php',
        type: 'POST',
        data: 'idU='+ idU + '&idJV='+ idJV + '&validation=' + validation, // on envoie le numero de l'utilisateur et du jeu, on le testera avec $_GET['idU'] et $_GET['idJV']
        dataType: 'json'
    });


    filterDataRequest.done(function(data) {
        //alert("success");
        //en cas de success on appelle le javascript pour recharger les commentaires DONC SANS celui qui vient d'être supprimé
        jsChargementCommentaires();
    });

    filterDataRequest.fail(function(jqXHR, textStatus) {
        //alert("ERROR, jqXHR : "+ jqXHR.responseText + "textStatus : "+ textStatus );
        console.log( "error" );
        if (jqXHR.status === 0){alert("Not connectn Verify Network.");}
        else if (jqXHR.status == 404){alert("Requested page not found. [404]");}
        else if (jqXHR.status == 500){alert("Internal Server Error [500].");}
        else if (textStatus === "parsererror"){alert("Requested JSON parse failed.");}
        else if (textStatus === "timeout"){alert("Time out error.");}
        else if (textStatus === "abort"){alert("Ajax request aborted.");}
        else{alert("Uncaught Error.n" + jqXHR.responseText);}
    });

    //TOUJOURS : une fois réceptionné les donnees en JSON, on récupére juste le message d erreur renvoye par l'AJAX
    filterDataRequest.always(function(data) {
        (document.getElementById('infoERREUR')).style.display = ""; //pour la mettre en affichage		
        $('#dialog1').text(""); //remise à blanc de la div
        //alert("SUCCES : " + data); console.log("success"); console.log(data);

        /*Pour afficher le message retourné en JSON par la requête AJAX*/
         $.each(data, function(index, value) {
                 if (index == "success"){	 // attention aux 3 égals : égalité stricte
                        document.getElementById('baliseA').className= "yes";	
                 }
                 else{
                         document.getElementById('baliseA').className= "no";	
                 }
                $('#dialog1').append(value);


        });	
    });
}; /*FIN DE LA FONCTION jsClickRadioButton*/
