function wrapper() {
    document.getElementById("flower_num").innerHTML='Wrappers';
    let flwrqty= document.getElementById("flwrqty");
    let wrppr= document.getElementById("wrpprcont");
    let rbbn= document.getElementById("rbbncont");
    let flwrs= document.getElementById("flwrscont");

    flwrqty.style.display="none";
    rbbn.style.display="none";
    flwrs.style.display="none";
    wrppr.style.display="grid";

}

function qty() {
   let q= document.getElementById("flower_num")
   q.innerHTML='Flower Quantity';

   let flwrqty= document.getElementById("flwrqty");
    let wrppr= document.getElementById("wrpprcont");
    let rbbn= document.getElementById("rbbncont");
    let flwrs= document.getElementById("flwrscont");

    flwrqty.style.display="flex";
    rbbn.style.display="none";
    flwrs.style.display="none";
    wrppr.style.display="none";

  
   
}

function ribbon(){
    document.getElementById("flower_num").innerHTML='Ribbons';
    
    let flwrqty= document.getElementById("flwrqty");
    let wrppr= document.getElementById("wrpprcont");
    let rbbn= document.getElementById("rbbncont");
    let flwrs= document.getElementById("flwrscont");

    flwrqty.style.display="none";
    rbbn.style.display="grid";
    flwrs.style.display="none";
    wrppr.style.display="none";
    
}

function flowers(){
    document.getElementById("flower_num").innerHTML='Flower 1';

    let flwrqty= document.getElementById("flwrqty");
    let wrppr= document.getElementById("wrpprcont");
    let rbbn= document.getElementById("rbbncont");
    let flwrs= document.getElementById("flwrscont");

    flwrqty.style.display="none";
    rbbn.style.display="none";
    flwrs.style.display="grid";
    wrppr.style.display="none";

}