function wrapper() {
    document.getElementById("flower_num").innerHTML='Wrappers';
    let flwrqty= document.getElementById("flwrqty");
    let wrppr= document.getElementById("wrpprcont");
    let rbbn= document.getElementById("rbbncont");
    let flwrs= document.getElementById("flwrscont");

    flwrqty.style.display="none";
    rbbn.style.display="none";
    flwrs.style.display="none";
    wrppr.style.display="flex";

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
    rbbn.style.display="flex";
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

let curr_flower=0


function update_flower(){

    document.querySelectorAll('.flower-container img').forEach((img)=>{
        img.classList.remove('active');
    });

    const flower =flwrs[curr_flower];
    document.getElementById(flower.id).classList.add('active');
    document.getElementById('flower_num').textContent= flower.label;
}

document.getElementById('right').addEventListener('click', ()=>{
    curr_flower=(curr_flower+1)%flwrs.length;
    update_flower();
});

document.getElementById('left').addEventListener('click', ()=> {
    curr_flower=(curr_flower-1+flwrs.length)%flwrs.length;
    update_flower();
});
update_flower();



const roseClick = async () => {
    try {
        const response = await fetch('http://localhost/khloris_/fetching.php');

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const products = await response.json();
        
        const redRose= products.find(product=>product.name ==="Red Rose");
        

        if (redRose){

            let flowerElement = document.getElementById(flwrs[curr_flower].id);
            if (flowerElement) {
                flowerElement.src = redRose.image_url; // Update image
                flowerElement.style.display = "block";
            }
            else{
                console.error('Red Rose not found');

            }
       

        } else{
            console.error('nope!');
        }


        

    }catch (error) {
        console.error('Error fetching products:', error);
    }
};

const TulipsClick = async () => {
    try {
        const response = await fetch('http://localhost/khloris_/fetching.php');

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const products = await response.json();
        
        const redTulip= products.find(product=>product.name ==="Red Tulip");
        

        if (redTulip){

            let flowerElement = document.getElementById(flwrs[curr_flower].id);
            if (flowerElement) {
                flowerElement.src = redTulip.image_url; // Update image
                flowerElement.style.display = "block";
            }
            else{
                console.error('Red Rose not found');

            }
       

        } else{
            console.error('nope!');
        }


        

    }catch (error) {
        console.error('Error fetching products:', error);
    }
};


const LilyClick = async () => {
    try {
        const response = await fetch('http://localhost/khloris_/fetching.php');

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const products = await response.json();
        
        const whitelily= products.find(product=>product.name ==="White Lily");
        

        if (whitelily){

            let flowerElement = document.getElementById(flwrs[curr_flower].id);
            if (flowerElement) {
                flowerElement.src = whitelily.image_url; 
                flowerElement.style.display = "block";
            }
            else{
                console.error('lily not found');

            }
       

        } else{
            console.error('nope!');
        }


        

    }catch (error) {
        console.error('Error fetching products:', error);
    }
};


const SunflowerClick = async () => {
    try {
        const response = await fetch('http://localhost/khloris_/fetching.php');

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const products = await response.json();
        
        const sunflower= products.find(product=>product.name ==="Sunflower");
        

        if (sunflower){

            let flowerElement = document.getElementById(flwrs[curr_flower].id);
            if (flowerElement) {
                flowerElement.src =sunflower.image_url; 
                flowerElement.style.display = "block";
            }
            else{
                console.error('lily not found');

            }
       

        } else{
            console.error('nope!');
        }


        

    }catch (error) {
        console.error('Error fetching products:', error);
    }
};


const DahliaClick = async () => {
    try {
        const response = await fetch('http://localhost/khloris_/fetching.php');

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const products = await response.json();
        
        const pinkdahlia= products.find(product=>product.name ==="Pink Dahlia");
        

        if (pinkdahlia){

            let flowerElement = document.getElementById(flwrs[curr_flower].id);
            if (flowerElement) {
                flowerElement.src = pinkdahlia.image_url; 
                flowerElement.style.display = "block";
            }
            else{
                console.error('redcarnation not found');

            }
       

        } else{
            console.error('nope!');
        }


        

    }catch (error) {
        console.error('Error fetching products:', error);
    }
};


const RedCarnationClick = async () => {
    try {
        const response = await fetch('http://localhost/khloris_/fetching.php');

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const products = await response.json();
        
        const redcarnation= products.find(product=>product.name ==="Red Carnation");
        

        if (redcarnation){

            let flowerElement = document.getElementById(flwrs[curr_flower].id);
            if (flowerElement) {
                flowerElement.src = redcarnation.image_url; 
                flowerElement.style.display = "block";
            }
            else{
                console.error('redcarnation not found');

            }
       

        } else{
            console.error('nope!');
        }


        

    }catch (error) {
        console.error('Error fetching products:', error);
    }
};



const IrisClick = async () => {
    try {
        const response = await fetch('http://localhost/khloris_/fetching.php');

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const products = await response.json();
        
        const violetiris= products.find(product=>product.name ==="Violet Iris");
        

        if (violetiris){

            let flowerElement = document.getElementById(flwrs[curr_flower].id);
            if (flowerElement) {
                flowerElement.src = violetiris.image_url; 
                flowerElement.style.display = "block";
            }
            else{
                console.error('violetiris not found');

            }
       

        } else{
            console.error('nope!');
        }


        

    }catch (error) {
        console.error('Error fetching products:', error);
    }
};


const PeonyClick = async () => {
    try {
        const response = await fetch('http://localhost/khloris_/fetching.php');

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const products = await response.json();
        
        const pinkpeony= products.find(product=>product.name ==="Pink Peony");
        

        if (pinkpeony){

            let flowerElement = document.getElementById(flwrs[curr_flower].id);
            if (flowerElement) {
                flowerElement.src = pinkpeony.image_url; 
                flowerElement.style.display = "block";
            }
            else{
                console.error('peony not found');

            }
       

        } else{
            console.error('nope!');
        }


        

    }catch (error) {
        console.error('Error fetching products:', error);
    }
};


const DaisyClick = async () => {
    try {
        const response = await fetch('http://localhost/khloris_/fetching.php');

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const products = await response.json();
        
        const daisy= products.find(product=>product.name ==="Daisy");
        

        if (daisy){

            let flowerElement = document.getElementById(flwrs[curr_flower].id);
            if (flowerElement) {
                flowerElement.src = daisy.image_url; 
                flowerElement.style.display = "block";
            }
            else{
                console.error('daisy not found');

            }
       

        } else{
            console.error('nope!');
        }


        

    }catch (error) {
        console.error('Error fetching products:', error);
    }
};


const AnemoneClick = async () => {
    try {
        const response = await fetch('http://localhost/khloris_/fetching.php');

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const products = await response.json();
        
        const purpleanemone= products.find(product=>product.name ==="Purple Anemone");
        

        if (purpleanemone){

            let flowerElement = document.getElementById(flwrs[curr_flower].id);
            if (flowerElement) {
                flowerElement.src = purpleanemone.image_url; 
                flowerElement.style.display = "block";
            }
            else{
                console.error('purpleanemone not found');

            }
       

        } else{
            console.error('nope!');
        }


        

    }catch (error) {
        console.error('Error fetching products:', error);
    }
};


const HydrangeaClick = async () => {
    try {
        const response = await fetch('http://localhost/khloris_/fetching.php');

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const products = await response.json();
        
        const bluehy= products.find(product=>product.name ==="Blue Hydrangea");
        

        if (bluehy){

            let flowerElement = document.getElementById(flwrs[curr_flower].id);
            if (flowerElement) {
                flowerElement.src = bluehy.image_url; 
                flowerElement.style.display = "block";
            }
            else{
                console.error('peony not found');

            }
       

        } else{
            console.error('nope!');
        }


        

    }catch (error) {
        console.error('Error fetching products:', error);
    }
};


const LilacClick = async () => {
    try {
        const response = await fetch('http://localhost/khloris_/fetching.php');

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const products = await response.json();
        
        const lilac= products.find(product=>product.id ==="54");
        

        if (lilac){

            let flowerElement = document.getElementById(flwrs[curr_flower].id);
            if (flowerElement) {
                flowerElement.src = lilac.image_url; 
                flowerElement.style.display = "block";
            }
            else{
                console.error('peony not found');

            }
       

        } else{
            console.error('nope!');
        }


        

    }catch (error) {
        console.error('Error fetching products:', error);
    }
};



