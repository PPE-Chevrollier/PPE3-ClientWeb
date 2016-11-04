 $(function(){
      $("#formInscriptionUser").validate({
      rules: {
          email: {
              required: true,
              email: true
          },
          pseudo: {
              required: true,
              minlength: 5,
              maxlength: 10
          }
      },
      messages: {
          email: {
              required: "Vous devez entrer un email",
              email: "Cet email est invalide"
          },
          pseudo: {
              required: "Vous devez entrer un pseudo",
              minlength: "Ce pseudo est trop court",
              maxlength: "Ce pseudo est trop long"
          }
      }
   });
});
 
