/* Gestisce le funzioni e gli elementi del dom sulla pagina "carrello.php"*/
$(document).ready(function () {	
	if (window.location.href.indexOf("carrello.php") > -1) {
      //rimuove tutti gli item dal carrello

      renderCart();
      removeAllItemsClick();

      //TODO: ONCLICK CHECKOUT BUTTON
   }
});

/* Aggiorna il carrello con i dati modificati,
Utilizzata a fine delle manipolazioni dinamiche del documento */
function renderCart() {
   $.ajax({
      url: "get_cart_list_db.php",
      method: "GET",
      success: function (data) {
         showCartProducts(data);

         //aggiungo il checkout
         getCheckoutData(data);
      },
      error: ajaxFailed,
   });
}

//rimuove tutti i prodotti dal carrello 
function removeAllItemsClick() {
   //REMOVE ALL PRODUCTS
   $("div.Header h5.Action").click(function () {
      $.ajax({
         url: "remove_all_items_from_cart_db.php",
         method: "POST",
         success: function (data) {
            // $("div.Cart-Items").remove();
            renderCart();
            $("div.error").text(data);
         },
         error: ajaxFailed,
      });
   });
}

/*
	Gestisce il click del tasto "checkout" ovvero la fase finale dell'acquisto
	e aggiorna i dati della quantità totale e somma totale dell'ordine
	*/
function getCheckoutData(data) {
   $.ajax({
      url: "get_data_from_cart.php",
      method: "GET",
      success: function (data) {

         var sum = data[0].sum != null ? data[0].sum : 0;
         var n_items = data[0].qnt != null ? data[0].qnt : 0;

         var hr = $("<hr id='end-cart' />");

         var checkout = $(
            "<div class='checkout'>" +
               "<div class='total'>" +
               "<div>" +
               "<div class='Subtotal'>Sub-Total</div>" +
               "<div class='items'>" +
               n_items +
               " items</div>" +
               "</div>" +
               "<div class='total-amount'>$" +
               sum +
               "</div>" +
               "</div>" +
               "<button class='button' id='checkout'>Checkout</button>" +
               "</div>"
         );

         $("#Cart-wrapper").append(hr);
         $("#Cart-wrapper").append(checkout);

         $("#checkout").click(function () {
            //rimuovo tutti gli oggetti dal carrello
            $.ajax({
               url: "remove_all_items_from_cart_db.php",
               method: "POST",
               data: {
                  checkout: true,
               },
               success: function (data) {
                  // $("div.Cart-Items").remove();
                  renderCart();

                  $("div.error").text(data);
                  $("div.error").css("color", "green");
               },
               error: ajaxFailed,
            });
         });
      },
      error: ajaxFailed,
   });
}

//mostra tutti prodotti nel carrello 
function showCartProducts(json) {
   $("#Cart-wrapper").empty();

   for (var key in json) {
      if (json.hasOwnProperty(key)) {
         // Rimpiazzo il nome delle categorie che contengono piu parole divise da spazi (es. 'Donkey Kong')
         // var category = json[key].Categoria.replace(/\s/g, "");
         var item = json[key];
         titolo = item.Titolo.replace(/\s/g, "");

         // Creo div con le info e le classi per quella categoria
         var div = $(
            "<div class='Cart-Items " +
               titolo +
               "'>" +
               "<div class='image-box'>" +
               "<img class='cart-img " +
               titolo +
               "'" +
               "src='" +
               item.Url_foto +
               "' alt='FOTO DI " +
               item.Titolo +
               "' id='" +
               // titolo +
               item.Titolo +
               "'/>" +
               "</div>" +
               "<div class='about'>" +
               "<h1 class='title'>" +
               item.Titolo +
               "</h1>" +
               "<h5 class='subtitle'>" +
               item.Categoria +
               "</h5>" +
               "</div>" +
               "<div class='counter'>" +
               "<div class='count'>Quantità: " +
               item.Quantita +
               "</div>" +
               "</div>" +
               "<div class='prices'>" +
               "<div class='amount'>$" +
               item.Prezzo +
               "</div>" +
               "<div class='remove rmv-one " +
               titolo +
               "' id='" +
               item.Titolo +
               "'><u>Remove 1</u></div>" +
               "<div class='remove rmv-all " +
               titolo +
               "' id='" +
               item.Titolo +
               "'><u>Remove all</u></div>" +
               "</div>" +
               "</div>"
         );

         // Aggiungo il div creato nel div "#categories"
         $("#Cart-wrapper").append(div);

         // Associo al div appena creato, che ha quella precisa categoria, un evento onclick
         $("img.cart-img." + titolo).click(function () {
            product_title = this.getAttribute("id");
            productClick(product_title);
         });

         $("div.remove.rmv-one." + titolo).click(function () {
            product_title = this.getAttribute("id");
            removeOneProduct(product_title);
         });
         $("div.remove.rmv-all." + titolo).click(function () {
            product_title = this.getAttribute("id");
            removeAllProduct(product_title);
         });
      }
   }
}

//rimuove 1 quantità di prodotto dal carrello
function removeOneProduct(title) {
   console.log(title);
   var titolo = title.replace(/\s/g, "");

   $.ajax({
      url: "remove_all_this_item_from_cart.php",
      method: "POST",
      data: {
         title: title,
         mode: "One",
      },
      success: function (data) {
         // $("div.Cart-Items." + titolo).remove();
         renderCart();
         $("div.error").text(data);
      },
      error: ajaxFailed,
   });
}
//rimuove tutte le quantità del prodotto dal carrello
function removeAllProduct(title) {
   //REMOVE ALL OF THIS PRODUCT
   var titolo = title.replace(/\s/g, "");

   $.ajax({
      url: "remove_all_this_item_from_cart.php",
      method: "POST",
      data: {
         title: title,
         mode: "All",
      },
      success: function (data) {
         // $("div.Cart-Items." + titolo).remove();
         renderCart();

         $("div.error").text(data);
      },
      error: ajaxFailed,
   });
}
