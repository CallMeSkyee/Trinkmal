let biere=[
  // Name, größe, preis, imgsrc, pfand
  ["Alfa","20L",59.99,"/trinkmal/images/Biere/Alfa.png", 30.00], 
  ["Benediktiner Hell","30L",74.99,"/trinkmal/images/Biere/Benedektiner.png", 30.00],
  ["Benediktiner Weissbier","30L",79.99,"/trinkmal/images/Biere/Benedektiner.png", 30.00],
  ["Bitburger Pils","15L",41.49,"/trinkmal/images/Biere/Bitburger.png", 25.00],
  ["Bitburger Pils","20L",51.99,"/trinkmal/images/Biere/Bitburger.png", 25.00],
  ["Bitburger Pils","30L",69.99,"/trinkmal/images/Biere/Bitburger.png", 30.00],
  ["Bolten Alt","30L",62.99,"/trinkmal/images/Biere/Bolten.png", 30.00],
  ["Brand","20L",79.99,"/trinkmal/images/Biere/Brand.png", 30.00],
  ["Diebels Alt","30L",79.99,"/trinkmal/images/Biere/Diebels.png", 30.00],
  ["Erdinger Weißbier","30L",79.99,"/trinkmal/images/Biere/Erdinger.png", 30.00],
  ["Frankenheimer Alt","30L",69.99,"/trinkmal/images/Biere/Frankenheim.png", 30.00],
  ["Früh Kölsch","30L",79.99,"/trinkmal/images/Biere/Kölsch.png", 30.00],
  ["Gaffel Kölsch","30L",77.99,"/trinkmal/images/Biere/Gaffel.png", 30.00],
  ["Grimbergen Dubbel","20L",99.99,"/trinkmal/images/Biere/Grimbergen.png", 30.00],
  ["Heineken","20L",66.99,"/trinkmal/images/Biere/Heineken.png", 30.00],
  ["Hertog Jan","20L",64.99,"/trinkmal/images/Biere/Hertog_jan.png", 30.00],
  ["Hoegaarden Rose","20L",89.99,"/trinkmal/images/Biere/Hoegaarden.png", 30.00],
  ["Hoegaarden Wit","20L",74.99,"/trinkmal/images/Biere/Hoegaarden.png", 30.00],
  ["Jupiler","20L",64.99,"/trinkmal/images/Biere/Jupiler.png", 30.00],
  ["Karmelit Tripel","20L",109.99,"/trinkmal/images/Biere/Karmeliten.png", 30.00],
  ["Krombacher Pils","30L",79.99,"/trinkmal/images/Biere/Krombacher.png", 30.00],
  ["König Ludwig Hell","30L",68.99,"/trinkmal/images/Biere/König_ludwig.png", 30.00],
  ["König Ludwig Weißbier","30L",69.99,"/trinkmal/images/Biere/König_ludwig.png", 30.00],
  ["Köstritzer Schwarzbier","30L",74.99,"/trinkmal/images/Biere/Köstriker.png", 30.00],
  ["La Chouffe Blonde","20L",99.99,"/trinkmal/images/Biere/La_Chouffe.jpg", 30.00],
  ["Leffe Blond","20L",84.99,"/trinkmal/images/Biere/Leffe.png", 30.00],
  ["Leffe Bruin","20L",84.99,"/trinkmal/images/Biere/Leffe.png", 30.00],
  ["Liefmans Fruitesse","20L",94.99,"/trinkmal/images/Biere/Liefmans.png", 30.00],
  ["Lindermans Kriek","20L",94.99,"/trinkmal/images/Biere/Lindermans.png", 30.00],
  ["Mystic Kriek","20L",94.99,"/trinkmal/images/Biere/Mystic_Kriek.png", 30.00],
  ["Paulaner Weißbier","30L",79.99,"/trinkmal/images/Biere/Paulaner.png", 30.00],
  ["Peroni","30L",89.99,"/trinkmal/images/Biere/Peroni.png", 30.00],
  ["San Miguel Tradicion","30L",73.99,"/trinkmal/images/Biere/San_miguel.png", 30.00],
  ["Warsteiner Pils","30L",63.99,"/trinkmal/images/Biere/Warsteiner.png", 30.00],
  ["La Trappe Blond","20L",84.99,"/trinkmal/images/Biere/La_Trappe.jfif", 30.00],
  ["La Trappe Dubble","20L",84.99,"/trinkmal/images/Biere/La_Trappe.jfif", 30.00],
  ["Rodenbach Fruitage","20L",81.99,"/trinkmal/images/Biere/Rodenbach.jfif", 30.00],
  ["Cornet Oaked Blond","20L",99.99,"/trinkmal/images/Biere/Cornet.png", 30.00],
]

function generateProducts(){
  for(let i =0; i<biere.length; i++){
      var codeBlock = document.getElementById("content-wrap");
      var item = document.createElement("div");
      var bName = biere[i][0];             
      var bSize = biere[i][1];
      var bPrice = biere[i][2]; 
      var logoUrl = biere[i][3];
      
      item.innerHTML =
          '<div class="card" id="'+i+'">'+
          /* Construct card using variables' information*/
          '<img class="img-fluid" src="'+ logoUrl +'">'+
          '<h2>'+ bName + '<br />'+ bSize + ' Fass' +'<br />'+'</h2>'+
          '<h2 class="pricing">'+ bPrice+'&#8364</h2>'+
                  '<div class="add">'+
                  /* call SaveItem(item_id) function from Storage.js on click*/
                  '<button class="button button1" onclick="addToLs('+ i +',1)">Kaufen</button>'+
                  '</div>'+
          '</div>';   
      codeBlock.appendChild(item);
  }
}

function generateCart(){
      console.log("Updating");
      var totalAmount = 0;
      var totalPledge = 0;
      var product_list = "";

      var i = 0;
      var codeBlock = document.getElementById("productBlock");
      codeBlock.innerHTML="";
      do{

        var item = document.createElement("div");
        var key = localStorage.key(i);

        if(localStorage.length==0){continue}
        if (isNaN(key) == true){
          console.log("NaN: --"+key);
          if(localStorage.length-1 == 0){
            codeBlock.innerHTML= "";
          }
          i++;
          continue;
        }

          var amount = localStorage.getItem(key);
          var pledge = biere[key][4]*amount;

          var bName = biere[key][0];          
          var bSize = biere[key][1];
          var bPrice = biere[key][2]; 
          var logoUrl = biere[key][3];
          
          var linePrice = (bPrice*amount).toFixed(2);

          totalAmount += Number(amount);
          totalPledge += pledge;

          product_list += String(amount + " x " + bName + " "+ bSize + " \n")
          
          item.innerHTML = '<div class="product">'+
                        '<div class="product-image">'+
                          '<img src="'+ logoUrl+'">'+
                        '</div>'+
                        '<div class="product-details">'+
                          '<div class="product-title"> </div>'+
                          '<p class="product-description">'+bName+' '+bSize+'</p>'+
                        '</div>'+
                        '<div class="product-price">'+bPrice+'&#8364;</div>'+
                        '<div class="product-quantity">'+
                          '<input type="number" id="input'+key+'" value="'+amount+'" min="1" max="5" oninput="updateQuantity('+key+')">'+
                        '</div>'+
                        '<div class="product-removal">'+
                          '<button class="remove-product" onclick="removeProduct('+key+')">'+
                            'Entfernen'+
                          '</button>'+
                        '</div>'+
                        '<div class="product-line-price">'+ linePrice+'</div>'+
                    '</div> </div>';
                
                codeBlock.appendChild(item);
                i++;
      }while(i <= localStorage.length-1) ;
      console.log(totalAmount);
      totals(totalAmount, totalPledge);
      document.getElementById("product_list").value = product_list;
}

function removeProduct(key){
  localStorage.removeItem(key);
  generateCart();
}

function updateQuantity(key){
  var id = "input" + key.toString();
  var newQuantity = document.getElementById(id).value;
  if(newQuantity > 5){
    newQuantity = 5;
  } else if(newQuantity < 1){
    newQuantity = 1;
  }
  localStorage.setItem(key,newQuantity);
  generateCart();
}

function totals(totalAmount, totalPledge){
  var lineTotals = document.getElementsByClassName("product-line-price");
  var subtotal = 0;
  for(i=1;i<lineTotals.length;i++){
    subtotal += Number(lineTotals[i].innerHTML);
  }
  document.getElementById("cart-subtotal").innerHTML = subtotal.toFixed(2)+'&#8364;';

  var taxes = subtotal*0.19;
  document.getElementById("cart-tax").innerHTML = taxes.toFixed(2)+'&#8364;';

  var shipping = totalAmount*15;
  document.getElementById("cart-shipping").innerHTML = shipping.toFixed(2)+'&#8364;';

  document.getElementById("cart-pledge").innerHTML = totalPledge.toFixed(2)+'&#8364;';

  var grandTotal = subtotal + shipping + totalPledge;

  document.getElementById("cart-total").innerHTML = grandTotal.toFixed(2)+ '&#8364;';
  document.getElementById("totalCheckout").value = grandTotal.toFixed(2);
}

function addToLs(item_id, item_amount) {
  var id = item_id;
  var amount = item_amount; //one by default

  localStorage.setItem(id, amount);
  // save currently selected items' name and price to local storage 
  generateCart();
}

function loadModal(){
  // Get the modal
  var modal = document.getElementById("myModal");
  
  // Get the button that opens the modal
  var btn = document.getElementById("openCart");
  
  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  
  // When the user clicks the button, open the modal 
  btn.onclick = function() {
    modal.style.display = "block";
  }
  
  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }
  
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
 } 

function loadLogin(){
 // Get the modal
 var modal = document.getElementById("LOGIN");
          
 // Get the button that opens the modal
 var btn = document.getElementById("openLogCont");
 // When the user clicks the button, open the modal 
 btn.onclick = function() {
     modal.style.display = "block";
 }
     
 // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
     if (event.target != modal && event.target !== btn && !isDescendantOrSelf(LOGIN, event.target)) {
         modal.style.display = "none";
     }
 }
}

function isDescendantOrSelf(parent, child){
  let node = child;
  while(node != null){
    if(node == parent){
      return true;
    }
    node = node.parentNode;
  }
  return false;
}
