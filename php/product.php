<?php 
	include("../html/top.html");
	include("db.php");

	if (!isset($_SESSION['email'])) { //se esiste (isset) salvo le info nell array $_SESSION(sessione iniziata nel top)
		header("Location: login.php"); //se esiste la sessione reindirizzo nella pagina dell utente
		exit;
	} 
	
	else if(!isset($_SESSION["product_title"])){ // in set_product_data è settata, cosi evito di accedere a questa pagina senza un prodsotto specifico
		header("Location: homepage.php"); 
		exit;
	}
	
	else if(!isset($_SESSION["json_all_product_data"])){ // in set_product_data è settata, cosi evito di accedere a questa pagina senza un prodsotto specifico
		header("Location: homepage.php"); 
		exit;
	}


	// print_r($_SESSION["json_all_product_data"] . "\n");

?>  
<main>
<!-- SESSIONE = <?= $_SESSION['email'] ?> -->

	<article>

		<section id="product-section">
			
			<div id="top-section">
				<!-- inserire l'immagine del prodotto  -->

				<!-- Inserire parte a dx della immagine con le info  -->

			
			<!-- inserire i bottoni compra e aggiungi al carrello -->
	
	

			</div>					
		</section>

		<hr>

		<section id= "products-carousel">
			<!-- 
				carosello con 4/5 immagini random dal databas
				magari della stessa categoria (?) 
				che siano draggable
			-->
		</section>

	</article>


</main>

<?php 
	include("../html/bottom.html")
?>