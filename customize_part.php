



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khloris</title>
    <link rel="stylesheet" href="customize_bea/homepage_.css" />
    <link rel="stylesheet" href="customize_bea/cutomize_.css"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
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
          <div class="total_cont">
            
              <span>Total: </span>
              <span id="ttl_">0</span>
            
            
          </div>
        </div>

        <div class="bttns_">
          <div class="bttn_bc">
            <button class="bc">
              <i class="fas fa-shopping-cart"></i>
              <span> Add to Cart</span>
              
            </button>
            <button class="bb">
              <i class="fas fa-shopping-bag"></i>
              <span> Buy now</span>
              
            </button>
    
          </div>
        </div>
        
      </div>
       
      </div>
      <div class="t">
        <div class="table_dec">here</div>
      </div>
      
     
      <!-- <header>
        <input type="checkbox" name="" id="toggler" />
        <label for="toggler" class="fas fa-bars"></label>
        <a href="#" class="logo">Khloris<span>.</span></a>
        <nav class="navbar">
          <a href="#Home">Home</a>
          <a href="#Customization">Customization</a>
          <a href="#Flowers">Flowers</a>
          <a href="#Occassions">Occassions</a>
        </nav>
        <div class="icons">
          <a href="#" class="fas fa-shopping-cart"></a>
          <a href="#" class="fas fa-user"></a>
        </div>
      </header> -->
    <!-- <div class="table_dec"></div>-->

    <!-- <section class="prdctmenu" id="prdctmenu">
     
      <div class="pr_container">
        <i class="fas fa-chevron-left" id="left" type="button"></i>
        <p id="flower_num">Flower Quantity</p>
        <i class="fas fa-chevron-right" id="right" type="button"></i>
        
        <div class="flwr_qty" id="flwrqty">
          <button type="button" class="bttn_qty">
            <span class="flower-text">3pcs Flower</span>
            <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725884527/flowers/frejiooabwmcae6jbduy.png" alt="flw3">
        </button>
        <button type="button" class="bttn_qty">
          <span class="flower-text">5pcs Flower</span>
          <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725884517/flowers/ieiuglhpcvqig6hvhdvd.png" alt="flw5">
        </button>
        <button type="button" class="bttn_qty">
          <span class="flower-text">7pcs Flower</span>
          <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725884518/flowers/anhgzimqnc21pa0mdwds.png" alt="flw7">
        </button>
        <button type="button" class="bttn_qty">
          <span class="flower-text">10pcs Flower</span>
          <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725884516/flowers/q1pvoi9toabugqiowfpu.png" alt="flw10">
      </button>
    
      
      


    </div>  -->
    <!--

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

       

      <div class="total_cont">
        <div class="total">
          <span>Total: </span>
          <span id="ttl">0</span>
        </div>
       
      </div>
      <div class="bttn_bc">
        <button class="bc">
          <i class="fas fa-shopping-cart"></i>
          <span> Add to Cart</span>
         
        </button>
        <button class="bb">
          <i class="fas fa-shopping-bag"></i>
          <span> Buy now</span>
         
        </button>

      </div>
     
      


      </div>
    </section>

   
    <img  src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725816172/flowers/y1yoygv4hch8kkitcf2m.png" id="stand" alt="stand">
    
    <div id="wrapper"  class="flower-container">
      <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725884518/flowers/kn0ygs1s9cqhbjrfym4n.png" alt="leaves1" id="leaves1">
      <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725884518/flowers/kn0ygs1s9cqhbjrfym4n.png" alt="leaves2" id="leaves2">


      <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1723880362/flowers/redcarnation.png" alt="flower10" id="flower10">
      <img src="" alt="flower9" id="flower9">
     
      <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1723359191/flowers/ms9xtemytwlhyyhqeabb.png" alt="flower7" id="flower7">
      <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725826062/flowers/jfmqz2y1dbifiulcvbdk.png" alt="flower6" id="flower6">
      <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725824086/flowers/uywfmvp2mlxuonwgdesh.png" alt="flower5" id="flower5">
      <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725817506/flowers/emj9un5g1kt7fwhh0ogx.png" alt="flower4" id="flower4">
      <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1726073109/flowers/ms3vruapnyhspj8hbejv.png" alt="flower3" id="flower3">
      <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1723359130/flowers/whiterose.png" alt="flower8" id="flower8">
      <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1723880362/flowers/stm3btzql1daz3mobly5.png" alt="flower2" id="flower2">
      <img src="" alt="flower1" id="flower1">
     
      <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1723359240/flowers/whiteribbon.png" alt="ribbon" id="ribbon_">

          
    </div>
    <div class="bttn_cont">
      <button type="button" class="bttn_main" onclick="qty()">
        <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725817500/flowers/t6bvu9sxphgpetyefvkl.png" alt="qty" >
        
      </button>

      <button type="button" class="bttn_main" id="wrppr" onclick="wrapper()" >
        
          <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1723359520/flowers/kjy5hmwbf14bxt0c4qox.png" alt="wrppr" >
         
        
      </button>
      <button type="button" class="bttn_main" id="rbbn" onclick="ribbon()">
        
        <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1723359239/flowers/ptp5lvmoclmdev8pn6hh.png" alt="rbbn" >
       
      
    </button>
    <button type="button" class="bttn_main" id="flwr" onclick="flowers()">
      <img src="https://res.cloudinary.com/dsfcl09md/image/upload/v1725820209/flowers/v3loxrq0thehmt5dghku.png" alt="flwr" >
       
      
    </button> 
     
    </div>-->
    
    

     <script src="customize_bea/khlorisjs.js"></script>
     <script src="customize_bea/wrapper.js"></script>
     <script src="customize_bea/ribbon.js"></script>
    </div>
  </body> 


</html> 