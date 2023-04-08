$(function () {
   if (window.location.href.indexOf("profilo.php") > -1) {
      hideAllForms();

      $("#addAdminBtn").click(function () {
         hideAllForms();

         $(".error").text("");
         $("#addAdmin").show();
      });

      $("#addProductBtn").click(function () {
         $(".error").text("");

         hideAllForms();

         $("#addProduct").show();
      });

      $("#deleteProductBtn").click(function () {
         $(".error").text("");

         hideAllForms();

         $("#deleteProduct").show();
      });

      $("#modifyProductBtn").click(function () {
         $(".error").text("");

         hideAllForms();

         $("#modifyProduct").show();
      });

      /* ajax calls */

      $("#addAdmin").submit(function (event) {
         event.preventDefault();

         if (!precheck_addAdmin()) {
            $("div.error").html("Compila i campi!");
            $(".error").css("color", "red");
         } else {
            var nome = $("input[name='nameAdmin']").val();
            var cognome = $("input[name='cognomeAdmin']").val();
            var email = $("input[name='emailAdmin']").val();
            var password = $("input[name='passwordAdmin']").val();

            var data = {
               action: "addAdmin",
               nome: nome,
               cognome: cognome,
               email: email,
               password: password,
            };

            $.ajax({
               url: "adminHandler.php",
               data: { data },
               type: "POST",
               datatype: "json",
               success: function (res) {
                  if (res == true) {
                     //admin inserito
                     $("div.error").html("Admin inserito con successo");
                     $(".error").css("color", "green");
                     hideAllForms();
                  } else {
                     $("div.error").html("Errore nell'inserimento dell'admin");
                     $(".error").css("color", "red");

                     hideAllForms();
                  }
               },
               error: ajaxFailed,
            });
         }
      });

      $("#addProduct").submit(function (event) {
         event.preventDefault();

         if (!precheck_addProduct_modify()) {
            $("div.error").html("Compila i campi!");
            $(".error").css("color", "red");
         } else {
            var titolo = $("input[name='titoloProdotto']").val();
            var categoria = $("input[name='categoriaProdotto']").val();
            var url_foto = $("input[name='url_fotoProdotto']").val();
            var descrizione = $("input[name='descrizioneProdotto']").val();
            var prezzo = $("input[name='prezzoProdotto']").val();

            var data = {
               action: "addProduct",
               titolo: titolo,
               categoria: categoria,
               url_foto: url_foto,
               descrizione: descrizione,
               prezzo: prezzo,
            };

            $.ajax({
               url: "adminHandler.php",
               data: { data },
               type: "POST",
               datatype: "json",
               success: function (res) {
                  if (res == true) {
                     //admin inserito
                     $("div.error").html("Prodotto inserito con successo");
                     $(".error").css("color", "green");
                     hideAllForms();
                  } else {
                     $("div.error").html(
                        "Errore nell'inserimento del prodotto"
                     );
                     $(".error").css("color", "red");

                     hideAllForms();
                  }
               },
               error: ajaxFailed,
            });
         }
      });

      $("#deleteProduct").submit(function (event) {
         event.preventDefault();

         var titolo = $("input[name='titoloProdottoDelete']").val();

         if (titolo == "") {
            $("div.error").html("Compila i campi!");
            $(".error").css("color", "red");
         } else {
            var data = {
               action: "deleteProduct",
               titolo: titolo,
            };

            $.ajax({
               url: "adminHandler.php",
               data: { data },
               type: "POST",
               datatype: "json",
               success: function (res) {
                  if (res == true) {
                     //admin inserito
                     $("div.error").html("Prodotto eliminato con successo");
                     $(".error").css("color", "green");
                     hideAllForms();
                  } else {
                     $("div.error").html("Errore nella rimozione del prodotto");
                     $(".error").css("color", "red");

                     hideAllForms();
                  }
               },
               error: ajaxFailed,
            });
         }
      });

      $("#modifyProduct").submit(function (event) {
         event.preventDefault();

         if (!precheck_addProduct_modify()) {
            $("div.error").html("Compila i campi!");
            $(".error").css("color", "red");
         } else {
            var titolo = $("input[name='titoloModify']").val();
            var categoria = $("input[name='categoriaModify']").val();
            var url_foto = $("input[name='url_fotoModify']").val();
            var descrizione = $("input[name='descrizioneModify']").val();
            var prezzo = $("input[name='prezzoModify']").val();

            var data = {
               action: "modifyProduct",
               titolo: titolo,
               categoria: categoria,
               url_foto: url_foto,
               descrizione: descrizione,
               prezzo: prezzo,
            };

            $.ajax({
               url: "adminHandler.php",
               data: { data },
               type: "POST",
               datatype: "json",
               success: function (res) {
                  if (res == true) {
                     //admin inserito
                     $("div.error").html("Prodotto modificato con successo");
                     $(".error").css("color", "green");
                     hideAllForms();
                  } else {
                     $("div.error").html("Errore nella modifica del prodotto");
                     $(".error").css("color", "red");

                     hideAllForms();
                  }
               },
               error: ajaxFailed,
            });
         }
      });
   }
});

//nasconde i form
function hideAllForms() {
   $("#addAdmin").hide();
   $("#addProduct").hide();
   $("#deleteProduct").hide();
   $("#modifyProduct").hide();
}

//controlla i dati del form "addAdmin"
function precheck_addAdmin() {
   const name = $("input[name='nameAdmin']").val();
   const surname = $("input[name='cognomeAdmin']").val();
   const email = $("input[name='emailAdmin']").val();
   const password = $("input[name='passwordAdmin']").val();

   // Check if name is not empty
   if (name.trim() === "") {
      $(".error").html("Please enter your name");
      return false;
   }

   // Check if surname is not empty
   if (surname.trim() === "") {
      $(".error").html("Please enter your surname");
      return false;
   }

   // Check if email is valid
   if (!emailRegex.test(email)) {
      $(".error").html("Invalid email address");
      return false;
   }

   // Check if password is valid
   if (!passwordRegex.test(password)) {
      $(".error").html(
         "Invalid password. The password must contain at least 8 characters, 1 uppercase letter and 1 number and 1 special character (!@#$%^&)"
      );
      return false;
   }

   return true;
}

//gestsice i dati nel form
function precheck_addProduct_modify() {
   const titolo = $("input[name='titoloProdotto']").val();
   const categoria = $("input[name='categoriaProdotto']").val();
   const url_foto = $("input[name='url_fotoProdotto']").val();
   const descrizione = $("input[name='descrizioneProdotto']").val();
   const prezzo = $("input[name='prezzoProdotto']").val();

   // Check if name is not empty
   if (titolo.trim() === "") {
      $(".error").html("Please enter title");
      return false;
   }

   // Check if surname is not empty
   if (categoria.trim() === "") {
      $(".error").html("Please enter category");
      return false;
   }
   if (url_foto.trim() === "") {
      $(".error").html("Please enter url_photo");
      return false;
   }
   if (descrizione.trim() === "") {
      $(".error").html("Please enter description");
      return false;
   }
   if (prezzo.trim() === "") {
      $(".error").html("Please enter product price");
      return false;
   }

   return true;
}
function precheck_modify() {
   const titolo = $("input[name='titoloModify']").val();
   const categoria = $("input[name='categoriaModify']").val();
   const url_foto = $("input[name='url_fotoModify']").val();
   const descrizione = $("input[name='descrizioneModify']").val();
   const prezzo = $("input[name='prezzoModify']").val();

   // Check if name is not empty
   if (titolo.trim() === "") {
      $(".error").html("Please enter title");
      return false;
   }

   // Check if surname is not empty
   if (categoria.trim() === "") {
      $(".error").html("Please enter category");
      return false;
   }
   if (url_foto.trim() === "") {
      $(".error").html("Please enter url_photo");
      return false;
   }
   if (descrizione.trim() === "") {
      $(".error").html("Please enter description");
      return false;
   }
   if (prezzo.trim() === "") {
      $(".error").html("Please enter product price");
      return false;
   }

   return true;
}
