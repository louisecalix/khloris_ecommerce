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
    flwrs.style.display="flex";
    wrppr.style.display="none";

}

const flwr3=[
    {id:'flower1', label:"Flower 1"},
    {id:'flower2', label:"Flower 2"},
    {id:'flower3', label:"Flower 3"}
]

const flwr5=[
    {id:'flower1', label:"Flower 1"},
    {id:'flower2', label:"Flower 2"},
    {id:'flower3', label:"Flower 3"},
    {id:'flower4', label:"Flower 4"},
    {id:'flower5', label:"Flower 5"}

]
const flwr7=[
    {id:'flower1', label:"Flower 1"},
    {id:'flower2', label:"Flower 2"},
    {id:'flower3', label:"Flower 3"},
    {id:'flower4', label:"Flower 4"},
    {id:'flower5', label:"Flower 5"},
    {id:'flower6', label:"Flower 6"},
    {id:'flower7', label:"Flower 7"}

]






const flwrs=[
    {id:'flower1', label:"Flower 1"},
    {id:'flower2', label:"Flower 2"},
    {id:'flower3', label:"Flower 3"},
    {id:'flower4', label:"Flower 4"},
    {id:'flower5', label:"Flower 5"},
    {id:'flower6', label:"Flower 6"},
    {id:'flower7', label:"Flower 7"},
    {id:'flower8', label:"Flower 8"},
    {id:'flower9', label:"Flower 9"},
    {id:'flower10', label:"Flower 10"},

]

let curr_flower=0;
let currlist= flwrs;

let selected_flowers=[]

// function addFlower(){
//     const f = currlist[curr_flower];

//     if(!selected_flowers.some(selected => selected.id === f.id)){
//         selected_flowers.push(f);
//     }else{
//         console.log(`${f.label} is on the list`);
//     }
//     updateselected()

// }
// function updateselected(){
//     console.log("Selected:", selected_flowers)
// }

function update_flower(){

    document.querySelectorAll('.flower-container img').forEach((img)=>{
        img.classList.remove('active');
        img.style.transform = 'scale(5)';
    });

    const flower =currlist[curr_flower];
    if (flower){
        const activeElement = document.getElementById(flower.id);
        if (activeElement) {
            activeElement.classList.add('active');
            activeElement.style.transform = 'scale(10)';

        document.getElementById('flower_num').textContent= flower.label;
    }
    }

}
document.getElementById('right').addEventListener('click', ()=>{
    curr_flower=(curr_flower+1)%currlist.length;
    update_flower();
});

document.getElementById('left').addEventListener('click', ()=> {
    curr_flower=(curr_flower-1+currlist.length)%currlist.length;
    update_flower();
});




document.querySelectorAll('.bttn_qty').forEach(button =>{
    button.addEventListener('click', ()=>{
        const selected =parseInt(button.getAttribute('data-qty'),10);

        switch(selected){
                case 3:
                    currlist = flwr3;
                    let three= document.getElementById("three_qty");
                    document.getElementById("five_qty").style.display='none';
                    document.getElementById("seven_qty").style.display='none';
                    document.getElementById("ten_qty").style.display='none';

                    three.style.display='flex';
                    three.style.transform= 'scale(1.3)';

                    wrpr= document.getElementById("wrapper");
                    wrpr.style.transform= 'scale(0.25)';

                    


                    break
                case 5:
                    currlist = flwr5;
                    document.getElementById("three_qty").style.display='flex';
                    document.getElementById("five_qty").style.display='flex';
                    document.getElementById("seven_qty").style.display='none';
                    document.getElementById("ten_qty").style.display='none';

                    wrpr= document.getElementById("wrapper");
                    wrpr.style.transform= 'scale(0.9)';
                    break;
                case 7:
                    currlist = flwr7;
                    document.getElementById("three_qty").style.display='flex';
                    document.getElementById("five_qty").style.display='flex';
                    document.getElementById("seven_qty").style.display='flex';
                    document.getElementById("ten_qty").style.display='none';

                    
                    wrpr= document.getElementById("wrapper");
                    wrpr.style.transform= 'scale(0.96)';
                    break;
                case 10:
                    currlist = flwrs;
                    document.getElementById("three_qty").style.display='flex';
                    document.getElementById("five_qty").style.display='flex';
                    document.getElementById("seven_qty").style.display='flex';
                    document.getElementById("ten_qty").style.display='flex';

                    wrpr= document.getElementById("wrapper");
                    wrpr.style.transform= 'scale(1)';
                    break;
                default:
                    currlist = flwrs;
            
        }

        curr_flower=0;
        update_flower();
    });


    
});
update_flower()


//Total
let curr_total=0.0;
let curr_flower_price=0.0;


const updateFlowerSelection = (flower) => {
    let flowerElement = document.getElementById(flwrs[curr_flower].id);
    if (flowerElement) {
        flowerElement.style.backgroundImage =  `url(${flower.image_url})`;
        flowerElement.style.display = "block";
        const flowerPrice = parseFloat(flower.price) || 0;
      
        curr_flower_price =flowerPrice;
        curr_total+=flowerPrice;
        
        updateTotalPrice(); 
    } else {
        console.error(`${flower.name} not found`);
    }
};


const flowerClick = async (flowerName) => {
    try {
        const response = await fetch('http://localhost/khloris_/khloris_ecommerce/customize_bea/fetching.php');

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const products = await response.json();
        const selectedFlower = products.find(product => product.name === flowerName);

        if (selectedFlower) {
            updateFlowerSelection(selectedFlower);
           
        } else {
            console.error('Flower not found');
        }

    } catch (error) {
        console.error('Error fetching products:', error);
    }
};






const roseClick = () => flowerClick("Red Rose");
const TulipsClick = () => flowerClick("Red Tulip");
const LilyClick = () => flowerClick("White Lily");
const SunflowerClick = () => flowerClick("Sunflower");
const DahliaClick = () => flowerClick("Pink Dahlia");
const RedCarnationClick = () => flowerClick("Red Carnation");
const IrisClick = () => flowerClick("Violet Iris");
const PeonyClick = () => flowerClick("Pink Peony");
const DaisyClick = () => flowerClick("Daisy");
const AnemoneClick = () => flowerClick("Purple Anemone");
const HydrangeaClick = () => flowerClick("Blue Hydrangea");
const LilacClick = () => flowerClick("Lilac");

const updateTotalPrice = () => {
    const TotalPricespan = document.getElementById('ttl_');

    // Get the current total value from #ttl_ (if it exists), or initialize to 0 if empty
    let existingTotal = parseFloat(TotalPricespan.textContent.replace('₱', '').replace(',', '').trim()) || 0;

    // Add the current flower price to the existing total
    let newTotal = existingTotal + curr_flower_price;

    // Update the displayed total price with proper formatting
    TotalPricespan.textContent = `₱${newTotal.toFixed(2)}`;
};



