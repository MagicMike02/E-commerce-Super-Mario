// TODO: RIMUOVI I "+ res" nel debug come nel .html();

// Regular expression for validating email addresses
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

// Regular expression for validating password
const passwordRegex =
   /^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[0-9]).{8,}$/;

let open;

$(document).ready(function () {
   // $(".error").css("background-color", "red");
   $(".error").click(function () {
      $(this).html("");
   });

   $("#loginbtn").click(function (event) {
      event.preventDefault();

      var data = {
         email: $("#email").val(),
         password: $("#password").val(),
      };
      console.log(data);
      console.log(data.email);

      if (precheck_login()) {
         $.ajax({
            url: "login_db.php",
            method: "POST",
            //$("form").serialize(),
            data: {
               data,
            },
            dataType: "json",
            success: function (res) {
               console.log("debug " + res.correctData);
               if (res.correctData == true) {
                  console.log("success " + res);

                  $(".error").css("color", "green");
                  $(".error").html("Login Riuscito!");
                  setTimeout(() => {
                     window.location.href = "../php/homepage.php";
                  }, 1000);
               } else {
                  // connessione errore
                  console.log("fail " + res);
                  $(".error").html("Email o password errati!");
               }
            },
         });
      }
   });

   $("#loginAdminbtn").click(function (event) {
      event.preventDefault();

      var data = {
         email: $("#email").val(),
         password: $("#password").val(),
      };
      console.log(data);
      console.log(data.email);

      if (precheck_login()) {
         $.ajax({
            url: "login_admin_db.php",
            method: "POST",
            //$("form").serialize(),
            data: {
               data,
            },
            dataType: "json",
            success: function (res) {
               console.log("debug " + res.correctData);
               if (res.correctData == true) {
                  console.log("success " + res);

                  $(".error").css("color", "green");
                  $(".error").html("Login Admin Riuscito!");
                  setTimeout(() => {
                     window.location.href = "../php/homepage.php";
                  }, 1000);
               } else {
                  // connessione errore
                  console.log("fail " + res);
                  $(".error").html("Admin Email o password errati!");
               }
            },
         });
      }
   });


   $("#registerbtn").click(function (event) {
      event.preventDefault();

      if (precheck_signup()) {
         var data = {
            name: $("#name").val(),
            surname: $("#surname").val(),
            email: $("#email").val(),
            password: $("#password").val(),
         };
         console.log(data);
         console.log(data.name);
         console.log(data.surname);
         console.log(data.email);
         console.log(data.password);

         $.ajax({
            url: "signup_db.php",
            method: "POST",
            //$("form").serialize(),
            data: {
               data,
            },
            dataType: "json",
            success: function (res) {
               console.log("debug " + res.result);

               if (res.result == "Accepted") {
                  //registrazione OK
                  console.log("success " + res);
                  $(".error").css("color", "green");
                  $(".error").html("Registrazione Riuscita!");
                  setTimeout(() => {
                     window.location.href = "../php/login.php";
                  }, 2000);
               } else if (res == "Email Not Valid") {
                  //errore Email non valida
                  // console.log("error email " + res);
                  $(".error").html("Email non valida, Riprova! " + res);
               } else {
                  //errore generico
                  // console.log("error generic " + res);
                  $(".error").html("Errore generico, Riprova! " + res);
               }
            },
         });
      }
   });


	
});

//controlla i dati inseriti nel form di signup
function precheck_signup() {
   const name = document.getElementById("name").value;
   const surname = document.getElementById("surname").value;
   const email = document.getElementById("email").value;
   const password = document.getElementById("password").value;
   const confirmPassword = document.getElementById("confirm-password").value;

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

   // Check if confirm password is not empty
   if (confirmPassword.trim() === "") {
      $(".error").html("Please confirm your password");
      return false;
   }

   // Check if password and confirm password match
   if (password !== confirmPassword) {
      $(".error").html("Passwords do not match");
      return false;
   }

   return true;
}

//controlla i dati inseriti nel form di login

function precheck_login() {
   // Get the email and password input fields
   const email = document.getElementById("email").value;
   const password = document.getElementById("password").value;

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
