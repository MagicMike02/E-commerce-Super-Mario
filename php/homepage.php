<?php 
	include("../html/top.html");
	include("db.php");

	if (!isset($_SESSION['email']) || 
	(isset($_SESSION['admin']) 
	and $_SESSION['admin'] == false )) { //se esiste (isset) salvo le info nell array $_SESSION(sessione iniziata nel top)
		header("Location: login.php"); //se esiste la sessione reindirizzo nella pagina dell utente
		exit;
	} 
	else{

?>  
<main>
	<!-- SESSIONE = <?= $_SESSION['email'] ?> <br><br> -->


	<?php include("carousel/carousel.php "); ?>


	<article id="products-wrapper">
		
	<!-- Griglia Categorie -->	
		<section id="categories">
		</section>
			
			
	<!-- Griglia prodotti  -->	
		<section id="products">
		</section>
	</article>

		
	<?php include("../html/about-us.html") ?>
	<?php include("../html/contact-form.html") ?>

</main>

<?php 
} 
include("../html/bottom.html")
?>