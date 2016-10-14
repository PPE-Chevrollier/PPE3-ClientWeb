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
              required: "vous devez entrer un email",
              email: "Cet email est invalide"
          },
          pseudo: {
              required: "vous devez entrer un email",
              minlength: "trop court",
              maxlength: "trop long"
          }
      }
});

});
 
