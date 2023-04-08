<?php 
	include("../html/top.html")
?>

<main id="main-form">
   <article id="article-form">
      <h2>Login Form</h2>

	 <?php 
		if (isset($_SESSION['email'])) { //se esiste (isset) salvo le info nell array $_SESSION(sessione iniziata nel top)
			header("Location: homepage.php"); //se esiste la sessione reindirizzo nella pagina dell utente
			exit;
		} else { 
	?>  


      <form class="login-form" method="post">
         <div class="container">

				<p class="error" ></p>

            <label for="email"><b>Email</b></label>
            <input
					id="email"
               type="text"
               placeholder="Enter Email"
               name="email"
               required
            />

            <label for="password"><b>Password</b></label>
            <input
					id="password"
               type="password"
               placeholder="Enter Password"
               name="password"
               required
            />

            <button id="loginbtn" type="submit">Login</button>
            <button id="loginAdminbtn" type="submit">Login come Amministratore</button>
				<div class="container signin">
           		<p>You dont have an account? <a href="signup.php">Sign in</a>.</p>
         	</div>
         </div>


      </form>

		<?php } ?>

   </article>
</main>

<?php 
	include("../html/bottom.html")
?>
