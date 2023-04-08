<?php 
	include("../html/top.html")
?>

<?php 
		if (isset($_SESSION['email'])) { //se esiste (isset) salvo le info nell array $_SESSION(sessione iniziata nel top)
			header("Location: homepage.php"); //se esiste la sessione reindirizzo nella pagina dell utente
			exit;
		} else { 
	?>  

<main id="main-form">
   <article id="article-form">
      <h2>Sign up Form</h2>

      <form class="login-form">
         <div class="container">

				<p class="error">  </p>

            <label for="name"><b>Name</b></label>
            <input
               type="text"
               placeholder="Enter name"
               name="name"
               id="name"
               required
            />
            <label for="surname"><b>Surname</b></label>
            <input
               type="text"
               placeholder="Enter surname"
               name="surname"
               id="surname"
               required
            />
            <label for="email"><b>Email</b></label>
            <input
               type="text"
               placeholder="Enter Email"
               name="email"
               id="email"
               required
            />

            <label for="password"><b>Password</b></label>
            <input
               type="password"
               placeholder="Enter Password"
               name="password"
               id="password"
               required
            />

            <label for="confirm-password"><b>Confirm Password</b></label>
            <input
               type="password"
               placeholder="Confirm Password"
               name="confirm-password"
               id="confirm-password"
               required
            />


            <button type="submit" id="registerbtn">Register</button>
         </div>

         <div class="container signin">
            <p>Already have an account? <a href="login.php">Login</a>.</p>
         </div>
      </form>
   </article>
</main>

<?php } ?>

<?php 
	include("../html/bottom.html")
?>
