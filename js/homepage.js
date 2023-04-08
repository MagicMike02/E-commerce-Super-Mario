$(function () {
   //ottengo il nome dell'account nella navbar
   getSession();

   //scroll smooth alle ancore
   $("a").on("click", function (event) {
      if (this.hash !== "") {
         // tolgo l'evento di default al click del tag a
         event.preventDefault();

         // conservo l'hash
         var hash = this.hash;
         // console.log(hash);

         $("html, body").animate(
            {
               scrollTop: $(hash).offset().top,
            },
            800,
            function () {
               window.location.hash = hash;
            }
         );
      }
   });

   var icona = true; // toad
   $("#draggableElem").draggable({ revert: true });
   $("#droppableZone").droppable({
      drop: function (event, ui) {
         if (icona == true) {
            icona = false;
            $("#draggableElem").attr("src", "../assets/navbar/Mario-head.png");
         } else {
            icona = true;
            $("#draggableElem").attr("src", "../assets/navbar/fungo.png");
         }

         $("#draggableElem").effect(
            "shake",
            {
               time: 4,
               distance: 10,
               direction: "left",
            },
            1000
         );
      },
   });

   var mario = true;
   $("#marioImg").on("click", function (event) {

      $("#marioImg").effect(
         "shake",
         {
            time: 4,
            distance: 10,
            direction: "left",
         },
         1000
      );

      if(mario == true){
         $("#marioImg").attr("src", "../assets/navbar/fungo.png");}

   });

   // Controllo che mi trovo nella homepage
   if (window.location.href.indexOf("homepage.php") > -1) {
      // Richiedo la lista delle categorie
      $.ajax({
         url: "get_category_list.php",
         type: "GET",
         datatype: "json",
         success: showCategories,
         error: ajaxFailed,
      });
      carousel_homepage();
      showAllProducts();
   }
});

//gestsice il carosello nella homepage
function carousel_homepage() {
   var currentIndex = 0;
   var images = $("#slideshow img");
   var imagesCount = images.length;
   var slideInterval = 3000;

   images.eq(currentIndex).addClass("active");

   setInterval(function () {
      images.eq(currentIndex).removeClass("active"); // eq = seleziono la slide corrente
      currentIndex = (currentIndex + 1) % imagesCount; // cosi torno alla prima slide
      images.eq(currentIndex).addClass("active");
   }, slideInterval);
}6

//mostra tutti i prodotti disponibili nella sezione dedicata
function showAllProducts() {
   $.ajax({
      url: "get_products_list_db.php",
      type: "GET",
      // data: "category=" + category,
      datatype: "json",
      success: showProducts,
      error: ajaxFailed,
   });
}

//ottiene la sessione attuale e agggiorna il valore del profilo nella navbar
function getSession() {
   $.ajax({
      url: "get_session.php",
      type: "GET",
      success: function (res) {
         console.log("SESSIONE : " + res);
         $("#profilo > a").text("Profilo " + res);
      },
      error: ajaxFailed,
   });
}

// Funzione che mostra tutte le categorie restituite dal database
function showCategories(json) {
   //cancello qualunque cosa ci sia prima
   $("#categories").empty();

   var category = "AllProducts";
   var div_all = $(
      "<div class='category-card " +
         category +
         "'>" +
         "<div class='category-body'>" +
         "<h5 class='category-title'>" +
         "Tutti" +
         "</h5>" +
         "</div>" +
         "</div>"
   );
	

   $("#categories").append(div_all);
   $("div.category-card." + category).click(showAllProducts);

   // Per ogni valore nell'array associativo del json ricevuto
   // --> creo un div con i dati di quella categoria e li aggiungo nel contenitore di categorie
   for (var key in json) {
      if (json.hasOwnProperty(key)) {
         // Rimpiazzo il nome delle categorie che contengono piu parole divise da spazi (es. 'Donkey Kong')
         var category = json[key].Categoria.replace(/\s/g, "");

         // Creo div con le info e le classi per quella categoria
         var div = $(
            "<div class='category-card " +
               category +
               "'>" +
               "<div class='category-body'>" +
               "<h5 class='category-title'>" +
               json[key].Categoria +
               "</h5>" +
               "</div>" +
               "</div>"
         );

         // Aggiungo il div creato nel div "#categories"
         $("#categories").append(div);

         // Associo al div appena creato, che ha quella precisa categoria, un evento onclick
         $("div.category-card." + category).click(categoryClick);
      }
   }
}

// Funzione per l'evento "click" su una determinata categoria
// Chiede i dati di ogni prodotto di quella determinata categoria
function categoryClick() {
   //Trovo il nome della categoria che voglio
   var category = $(this).find("h5").text();

   // Richiedo la lista dei prodotti della categoria cliccata
   $.ajax({
      url: "get_products_list_db.php",
      type: "GET",
      data: "category=" + category,
      datatype: "json",
      success: showProducts,
      error: ajaxFailed,
   });
}

// Funzione che inserisce i Prodotti restituiti dal database
function showProducts(json) {
   // Pulisco la zona dei prodotti
   $("#products").empty();

   // Per ogni valore nell'array associativo del json ricevuto
   // --> creo un div con i dati di quel prodotto, di quella det. categoria,
   // --> e li aggiungo nel contenitore dei prodotti
   for (var key in json) {
      if (json.hasOwnProperty(key)) {
         var item = json[key];

         // Rimpiazzo il titolo dei prodotti che contengono piu parole divise da spazi (es. 'Poster Super Mario Galaxy')
         titolo = item.Titolo.replace(/\s/g, "");

         // Creo div con le info e le classi di questo determinato prodotto
         var div =
            "<div class='products-card " +
            titolo +
            "'> " +
            "<img src='" +
            item.Url_foto +
            "' alt='FOTO DI " +
            item.Titolo +
            "' class='products-img " +
            titolo +
            "' id='" +
            // titolo +
            item.Titolo +
            "'>" +
            "<div class='products-body'> " +
            "<h5 class='products-title'>" +
            item.Titolo +
            "</h5>" +
            "<p class='products-description'>" +
            item.Descrizione +
            "</p>" +
            "<div class='products-buttons'>" +
            "<button class='products-btn products-addcart " +
            titolo +
            "' id='" +
            item.Titolo +
            "' href='#'>" +
            "Aggiungi al carrello" +
            "</button>" +
            "</div>" +
            " </div>" +
            " </div>";

         // Aggiungo il div creato nel div "#products"
         $("#products").append(div);

         var product_title = item.Titolo;

         $("img." + titolo).click(function () {
            // product_title = $(this).find("h5").text();
            product_title = this.getAttribute("id");
            console.log("titolo = " + product_title);
            productClick(product_title);
         });

         $("button.products-btn.products-addcart." + titolo).click(function () {
            // product_title = this.getAttribute("id");
            // alert(this.id);

            $(this).animate({ width: "+=50" });
            $(this).animate({ width: "-=50" });
            $("#droppableZone").effect(
               "shake",
               {
                  time: 3,
                  distance: 20,
                  direction: "down",
               },
               1000
            );

            product_title = this.id;
            addToCartButtonClick(product_title);
         });
      }
   }
}

// Funzione per l'evento "click" su una determinato Prodotto
// Chiede i dati di quello specifico prodotto
//@param TITOLO CON SPAZI
function productClick(product_title) {
   // console.log("Cliccato! " + this);

   // console.log("Cliccato! " + product_title);

   console.log("productClick > product_title = " + product_title);
   $.ajax({
      // Richiedo i dati del prodotto cliccato
      url: "set_product_data.php", // --> imposta $_SESSION["product_title"] = $_GET['product_title'];
      type: "POST",
      data: {
         product_title: product_title,
      },
      datatype: "json",
      success: function (res) {
         if (res.correctData == true) {
            // Stampo dati di ritorno dalla chiamata ajax
            console.log(
               "Ajax Success -> productClick ->  res.correctData= " +
                  res.correctData
            );

            // Informo del reindirizzamento
            console.log("Redirect to Single Product Page");
            setTimeout(() => {
               window.location.href = "../php/product.php";
            }, 500);
         } else {
            // Stampo dati di ritorno dalla chiamata ajax
            console.log(
               "Ajax Error -> productClick -> res.correctData= " +
                  res.correctData
            );

            //Infdormo che NON ci sarà reindirizzamento
            console.log("Nessun reindirizzamento, Riprova");
         }
      },
      error: ajaxFailed,
   });
}

//gestisce il click al tasto ""aggiungi al carrello"
function addToCartButtonClick(title) {
   // alert("ADD TO CART " + title);
   var quantity = 1; // DEFAULT VALUE SE CLICCO IL TASTO DALLA CARD DEL PRODOTTO
   $.ajax({
      url: "set_product_data.php", // --> imposta $_SESSION["product_title"] = $_POST['product_title'];
      type: "POST",
      data: {
         product_title: title,
      },
      datatype: "json",
      success: function (res) {
         if (res.correctData == true) {
            addToCart(title, quantity);
         } else {
            console.log(
               "Ajax Error -> addToCartButtonClick -> res.correctData= " +
                  res.correctData
            );
         }
      },
      error: ajaxFailed,
   });
}

//chaimata ajax per aggiungere al carrello quel prodotto
function addToCart(title, quantity) {
   console.log("addToCart -->" + title);

   $.ajax({
      url: "add_to_cart_db.php",
      type: "POST",
      data: {
         quantity: quantity,
      },
      datatype: "json",
      success: function (res) {
         // alert(res);
         if (res == true) {
            // alert("add to cart success -->" + title);
            console.log("titolo successs-->" + title);
            title = title.replace(/\s/g, "");
            $("button.products-addcart." + title).text("AGGIUNTO");
            // (title);
         } else {
            // alert("ERRORE!");
            console.log("ERRORE");
         }
      },
   });
}

//funzione che notifica fallimento della richiesta ajax
function ajaxFailed(e) {
   var errorMessage = "Error making Ajax request:\n\n";

   errorMessage +=
      "Server status:\n" +
      e.status +
      " " +
      e.statusText +
      "\n\nServer response text:\n" +
      e.responseText;
   alert(errorMessage);
}
