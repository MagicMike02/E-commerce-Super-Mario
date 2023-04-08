$(document).ready(function () {
   if (window.location.href.indexOf("product.php") > -1) {
      // Ottengo i dati del prodotto che ho appena cliccato
      // --> (con la variabile di sesione $_SESSION["json_all_product_data"])

      // mostra --> product-section
      $.ajax({
         url: "get_product_data_db.php",
         type: "GET",
         success: showSingleProduct,
         error: ajaxFailed,
      });

      // mostra --> products-carousel
      $.ajax({
         url: "./carousel/get_carousel_data_db.php",
         type: "GET",
         success: insertProductCarousel,
         error: ajaxFailed,
      });
   }
});

// Funzione che mostra i dati del prodotto cliccato
function showSingleProduct(json) {
   // alert("showSingleProduct");
   $("#sx-section").empty();
   $("#dx-section").empty();
   $("#buttons-section").empty();

   console.log("showSingleProduct --> " + json);

   for (var key in json) {
      if (json.hasOwnProperty(key)) {
         var item = json[key];
         titolo = item.Titolo.replace(/\s/g, "");

         var img =
            "<img src='" +
            item.Url_foto +
            "' alt='" +
            item.Titolo +
            "' id='product-sx-section-img'>";

         var info =
            "<div id='product-dx-section-info' >" +
            "<h4 id='product-dx-title' >" +
            item.Titolo +
            "</h4>" +
            "Prezzo:" +
            "<p id='product-dx-price'>  € " +
            item.Prezzo +
            "</p>" +
            "</div>";

         var quantity_counter =
            "<div id='product-dx-quantity-counter-wrapper'>" +
            "Quantità: " +
            "<div id='product-dx-quantity-counter'>" +
            "<span id='quantity-counter-minus'> - </span>" +
            "<span id='quantity-counter-number'> 1 </span>" +
            "<span id='quantity-counter-plus'> + </span>" +
            "</div>";

         var description =
            "<div id='product-dx-description-wrapper'>" +
            "<p id='product-dx-description'>Descrizione:</br>" +
            item.Descrizione +
            "</p>" +
            "</div>";

         var buttons =
            "<div id='buttons-section'>" +
            "<div class='products-buttons  '>" +
            "<button class='btn-text-responsive products-btn products-addcart " +
            titolo +
            "' id='" +
            item.Titolo +
            "' href='#'>" +
            "	Aggiungi al carrello" +
            "</button>" +
            "</div></div>";

         // var product_title = item.Titolo; // == titolo CON SPAZI

         // $("button.products-btn.products-buy." + titolo).click(function () {
         //    // product_title = $(this).find("h5").text();
         //    buyNowButton(product_title);
         // });

         // $("button.products-btn.products-addcart." + titolo).click(function () {
         //    // product_title = $(this).find("h5").text();
         //    addToCartButton(product_title);
         // });

         $("#top-section").append(img);
         $("#top-section").append(info);
         // $("#product-dx-section-info").append(select_dropdown);
         $("#product-dx-section-info").append(quantity_counter);
         $("#product-dx-section-info").append(description);
         $("#product-dx-section-info").append(buttons);
      }
      // $("button.products-btn.products-buy." + titolo).click(function () {
      //    // product_title = this.getAttribute("id");
      //    product_title = this.id;
      //    buyNowButton(product_title);
      // });

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
         // addToCartButtonClick(product_title);
         addToCartQuantityButtonClick(product_title, quantity);
      });

      // FUNZIONE PER IL CONTATORE
      let quantity = 1;
      const number = $("#quantity-counter-number");
      $("#quantity-counter-plus").on("click", function () {
         quantity++;
         number.text(quantity);
         // console.log(quantity);
      });

      $("#quantity-counter-minus").on("click", function () {
         if (quantity > 1) {
            quantity--;
         }
         number.text(quantity);
         // console.log(quantity);
      });
   }
}

//gestsice l'evento del click all'aggiunghi al carrelo nella pagina products
// in cui si puo aumentare la quantità dei prodotti
function addToCartQuantityButtonClick(title, quantity) {
   $.ajax({
      url: "set_product_data.php",
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

// Ritorna un carosello con #n immagini dentro che hanno url = Url_foto di alcuni prodotti el DB
function insertProductCarousel(json) {
   //Qui ho il json che gli url
   //devo inserire il carosello con gli append

   console.log("json insertProductCarousel-->" + json);

   // inserisco il carosello
   var list = " <div id='list-recommended-products'></div>";
   $("#products-carousel").append(list);

   //per ogni valore nell'array di url che ho nel json
   for (var key in json) {
      if (json.hasOwnProperty(key)) {
         // urls[key];

         var item = json[key];
         console.log("insertProductCarousel -->" + item);
         titolo = item.Titolo.replace(/\s/g, "");

         var img =
            "<div class='recommended-products-card " +
            titolo +
            "'> " +
            "<img src='" +
            item.Url_foto +
            "' alt='FOTO DI " +
            item.Titolo +
            "' class='recommended-products-img " +
            titolo +
            "' id='" +
            item.Titolo +
            "'>" +
            "<div class='recommended-products-body'> " +
            "<h5 class='recommended-products-title'>" +
            item.Titolo +
            "</h5>" +
            "<p class='recommended-products-description'>" +
            item.Descrizione +
            "</p>" +
            "<div class='products-buttons'>" +
            /*"<button class='btn-text-responsive products-btn products-buy " +
            titolo +
            "' id='" +
            item.Titolo +
            "' href='#'>" +
            "Compra ora a <span class='button-price'>" +
            item.Prezzo +
            "</span></button>" +*/
            "<button class='btn-text-responsive products-btn products-addcart " +
            titolo +
            "' id='" +
            item.Titolo +
            "' href='#'>" +
            "Aggiungi al carrello" +
            "</button>" +
            "</div>" +
            " </div>" +
            " </div>";

         $("#list-recommended-products").append(img);

         // $(".recommended-products-card." + titolo).click(function () {
         //    var product_title = $(this).find("h5").text();
         //    productClick(product_title);
         // });

         $("img." + titolo).click(function () {
            var product_title = this.getAttribute("id");
            console.log("titolo = " + product_title);
            productClick(product_title);
         });

         /* $("button.products-btn.products-buy." + titolo).click(function () {
            // product_title = this.getAttribute("id");
            product_title = this.id;
            buyNowButton(product_title);
         });*/

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
