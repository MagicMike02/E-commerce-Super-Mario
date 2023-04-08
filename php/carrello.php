<?php 
	include("../html/top.html");
	include("db.php");

	if (!isset($_SESSION['email'])) { //se esiste (isset) salvo le info nell array $_SESSION(sessione iniziata nel top)
		header("Location: login.php"); //se esiste la sessione reindirizzo nella pagina dell utente
		exit;
	} 
	else { 
?>
<main id="main-cart">
   <!-- Ciao <?= $_SESSION['email'] ?>  <br>
	<?= $_SESSION['nome'] ?> 
	<?= $_SESSION['cognome'] ?>

	<p>Questo è il tuo carrello</p> -->


   <div class="CartContainer">
      <div class="Header">
         <h3 class="Heading">Shopping Cart</h3>
         <div class="error"></div>
         <h5 class="Action">Remove all</h5>
         <!-- Controllo se cisono prodotti altrimenti .hide()-->
      </div>

      <div id="Cart-wrapper">
      </div>
   </div>
</main>

<?php 
} 
include("../html/bottom.html")
?>
