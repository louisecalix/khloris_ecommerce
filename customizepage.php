<?php
session_start();
include 'php/config.php';


if (isset($_SESSION['wrapper'])) {
    $wrapper = $_SESSION['wrapper'];  
    $wrapperPrice = $wrapper->price;
    $wrapperProductId = $wrapper->product_id;
} else {
    $wrapperPrice = null;
    $wrapperProductId = null;
}

if (isset($_SESSION['ribbon'])) {
    $ribbon = $_SESSION['ribbon']; 
    $ribbonPrice = $ribbon->price;
    $ribbonProductId = $ribbon->product_id;
} else {
    $ribbonPrice = null;
    $ribbonProductId = null;
}

if (isset($_SESSION['flowers'])) {
    $flowers = $_SESSION['flowers'];  
    $firstFlowerPrice = $flowers[0]->price;
    $firstFlowerProductId = $flowers[0]->product_id;
} else {
    $flowers = [];
    $firstFlowerPrice = null;
    $firstFlowerProductId = null;
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khloris</title>
    <link rel="stylesheet" href="customize_bea/homepage_.css" />
    <link rel="stylesheet" href="custom6.css"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    /> 

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    

  </head>
  <body>
    <div class="container_grid">
        <div class="head"> 
          <?php include 'header.php'; ?>
      </div>
      <div class="choices">

        <div class="qty_">
          <button type="button" class="bttn_main" onclick="qty()">
            <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725817500/flowers/t6bvu9sxphgpetyefvkl.png" alt="qty" >
            
          </button>
        </div>

        <div class="wrapper_">
          <button type="button" class="bttn_main" id="wrppr" onclick="wrapper()" >
        
            <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1723359520/flowers/kjy5hmwbf14bxt0c4qox.png" alt="wrppr" >
           
          
        </button>
        </div>

        <div class="ribbons_">
          <button type="button" class="bttn_main" id="rbbn" onclick="ribbon()">
        
            <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1723359239/flowers/ptp5lvmoclmdev8pn6hh.png" alt="rbbn" >
           
          
        </button>
        </div>

        <div class="flowers_">
          <button type="button" class="bttn_main" id="flwr" onclick="flowers()">
            <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725820209/flowers/v3loxrq0thehmt5dghku.png" alt="flwr" >
             
            
          </button> 
        </div>
        
      </div>

      <div class="main">
         
          <div id="wrapper"  class="flower-container">
            <div id="leaves1"></div>
            <div id="leaves2"></div>

            <div class="ten" id="ten_qty">
              <div id="flower10"></div>
              <div id="flower9"></div>
              <div id="flower8"></div>
            </div>
              
            <div class="seven" id="seven_qty">
              <div id="flower7"></div>
              <div id="flower6"></div>
            </div>
            <div class="five" id="five_qty">
              
              <div id="flower5"></div>
              <div id="flower4"></div>
            </div>

            <div class="three" id="threeqty">
              <div id="flower1"></div>
              <div  id="flower3"></div>

              <div id="flower2"></div>
            </div>
          
            <div id="ribbon_"></div>


            <div id="leaves1"></div>
            <div id="leaves2"></div>

          </div> 


      </div>





      <div class="prdct_cont">
       
          <div class="label_">
            <div class="left_div"><i class="fas fa-chevron-left" id="left" type="button"></i></div>
            <div class="label_main>"><p id="flower_num">Flower Quantity</p></div>
          <div class="right_div"><i class="fas fa-chevron-right" id="right" type="button"></i></div>

          </div>

          <div class="main_div">
     
         
            <div class="flwr_qty" id="flwrqty">
              <button type="button" class="bttn_qty" data-qty="3">
                <span class="flower-text">3pcs Flower</span>
                <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725884527/flowers/frejiooabwmcae6jbduy.png" alt="flw3">
              </button>
              <button type="button" class="bttn_qty"data-qty="5">
                <span class="flower-text">5pcs Flower</span>
                <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725884517/flowers/ieiuglhpcvqig6hvhdvd.png" alt="flw5">
              </button>
              <button type="button" class="bttn_qty" data-qty="7">
                <span class="flower-text">7pcs Flower</span>
                <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725884518/flowers/anhgzimqnc21pa0mdwds.png" alt="flw7">
              </button>
              <button type="button" class="bttn_qty" data-qty="10">
                <span class="flower-text">10pcs Flower</span>
                <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725884516/flowers/q1pvoi9toabugqiowfpu.png" alt="flw10">
              </button>

            </div>
            <div class="wrppr_cont" id="wrpprcont">
         
         

            </div>
            <div class="rbbn_cont" id="rbbncont">
            
    
            </div>
            <div class="flwrs_cont" id="flwrscont">
              <div class="f_row">
    
                <button type="button" class="flwr_b" id="rose" onclick=roseClick()></button>
                <button type="button" class="flwr_b" id="tulip" onclick=TulipsClick()></button>
                <button type="button" class="flwr_b" id="lily" onclick="LilyClick()"></button>
                <button type="button" class="flwr_b" id="sunflower" onclick="SunflowerClick()"></button>
                
              </div>
              <div class="f_row">
    
                <button type="button" class="flwr_b" id="dahlia" onclick="DahliaClick()"></button>
                <button type="button" class="flwr_b" id="carnation" onclick="RedCarnationClick()"></button>
                <button type="button" class="flwr_b" id="iris" onclick="IrisClick()"></button>
                <button type="button" class="flwr_b" id="peony" onclick="PeonyClick()"></button>
                
              </div>
              <div class="f_row">
            
                <button type='button' class='flwr_b' id='daisy' onclick="DaisyClick()"></button>
            
                <button type="button" class="flwr_b" id="anemone" onclick="AnemoneClick()"></button>
                <button type="button" class="flwr_b" id="hydrangea" onclick="HydrangeaClick()"></button>
                <button type="button" class="flwr_b" id="lilac " onclick="LilacClick()"></button>
                
              </div>
            </div>
      
          
      <div class="other">

        <div class="ttl">
          <div class="total_cont" id="ttlcnt">
            
              <span>Total: </span>
              <span id="ttl_">0</span>
            
            
          </div>
        </div>

        <div class="bttns_">
          
            <button class="bb">
              <i class="fas fa-shopping-bag"></i>
              <span> Buy now</span>
              
            </button>
    
          </div>
        </div>
        
      </div>
       
      </div>
      <div class="t">
        <div class="table_dec"></div>
      </div>
      
     
<!-- <script src="khloris3.js"></script> -->

<script type="module" src="customize1.js"></script>
<script type="module" src="wrappers.js"></script>
<script type="module" src="customize2.js"></script>
<script type="module" src="ribbon-update.js"></script>
<!-- <script type="module" src="main.js"></script> -->

<script src="flowerSelection1.js"></script>

<script type="module"  src="flower-ttl.js"></script>

<script>
$(document).ready(function () {
  $('.bb').on('click', function (e) {
    e.preventDefault(); 

    
    const wrapperPrice = sessionStorage.getItem('wrapper_price');
    const wrapperProductId = sessionStorage.getItem('wrapper_product_id');
    const ribbonPrice = sessionStorage.getItem('ribbon_price');
    const ribbonProductId = sessionStorage.getItem('ribbon_product_id');
    
    const flowerDataStr = sessionStorage.getItem('selected_flowers');
    let flowerData = [];
    try {
      flowerData = flowerDataStr ? JSON.parse(flowerDataStr) : [];
    } catch (e) {
      console.error("Error parsing flower data:", e);
      return;
    }

    if (!wrapperPrice || !wrapperProductId || !ribbonPrice || !ribbonProductId || flowerData.length === 0) {
      console.error("Some product data is missing. Please make sure to select a wrapper, ribbon, and flower.");
      return;
    }


    const data = {
      wrapper: {
        price: wrapperPrice,
        product_id: wrapperProductId
      },
      ribbon: {
        price: ribbonPrice,
        product_id: ribbonProductId
      },
      flowers: flowerData.map(flower => ({
        product_id: flower.product_id,
        name: flower.name,
        price: flower.price,
        quantity: flower.qty,
        total_price: flower.total_price
      }))
    };

    console.log("Sending data:", data);
    console.log("Wrapper Price:", sessionStorage.getItem('wrapper_price'));
console.log("Wrapper Product ID:", sessionStorage.getItem('wrapper_product_id'));
console.log("Ribbon Price:", sessionStorage.getItem('ribbon_price'));
console.log("Ribbon Product ID:", sessionStorage.getItem('ribbon_product_id'));
console.log("Flower Data:", sessionStorage.getItem('selected_flowers'));
  
    $.ajax({
      url: 'customcheckout.php', // The PHP script to process the request
      type: 'POST',
      contentType: 'application/json',
      data: JSON.stringify(data), // Convert the data object to JSON
      success: function(response) {
        console.log('Data sent successfully:', response);
        // Optionally handle the response from the PHP script
        window.location.href = 'customcheckout.php'; // Redirect to checkout page
      },
      error: function(xhr, status, error) {
        console.error('Error sending data:', error);
      }
    });
  });
});

</script>



   
    </div>
  </body> 


</html> 