function wrapper() {
    document.getElementById("flower_num").innerHTML='Wrappers';
    let flwrqty= document.getElementById("flwrqty");
    let wrppr= document.getElementById("wrpprcont");
    let rbbn= document.getElementById("rbbncont");
    let flwrs= document.getElementById("flwrscont");
    let ttl = document.getElementById("ttlcnt");
    ttl.style.display= "none";

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
    let ttl = document.getElementById("ttlcnt");
    ttl.style.display= "none";

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
    let ttl = document.getElementById("ttlcnt");
    ttl.style.display= "none";

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
    let ttl = document.getElementById("ttlcnt");
    ttl.style.display= "flex";

    flwrqty.style.display="none";
    rbbn.style.display="none";
    flwrs.style.display="grid";
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

let curr_flower = 0;
let currlist = flwrs;
let selected_flowers = JSON.parse(sessionStorage.getItem('selected_flowers')) || [];

// Initialize or reset the session values if needed
const resetSession = () => {
    sessionStorage.setItem('curr_total', '0'); // Reset the total to zero
    sessionStorage.setItem('curr_flower_price', '0'); // Reset the flower price
    sessionStorage.setItem('selected_flowers', JSON.stringify([])); // Reset selected flowers
    window.curr_total = 0.0;
    window.curr_flower_price = 0.0;
    selected_flowers = [];
    console.log('Session reset');
};

// Call resetSession if you want to reset the session data at the start or on some specific event (e.g., page load or button click).
resetSession(); // For example, you can call this during page load or when you want to reset the session

// Log initial session storage to check values
console.log('Initial session storage:', {
    curr_total: window.curr_total,
    curr_flower_price: window.curr_flower_price,
    selected_flowers: selected_flowers
});

const update_flower = () => {
    document.querySelectorAll('.flower-container img').forEach((img) => {
        img.classList.remove('active');
    });

    const flower = currlist[curr_flower];
    if (flower) {
        const activeElement = document.getElementById(flower.id);
        activeElement.classList.add('active');
        document.getElementById('flower_num').textContent = flower.label;
    }
};

// Event listeners for flower navigation
document.getElementById('right').addEventListener('click', () => {
    curr_flower = (curr_flower + 1) % currlist.length;
    update_flower();
});

document.getElementById('left').addEventListener('click', () => {
    curr_flower = (curr_flower - 1 + currlist.length) % currlist.length;
    update_flower();
});

// Update flower list based on quantity selection
document.querySelectorAll('.bttn_qty').forEach(button => {
    button.addEventListener('click', () => {
        const selected = parseInt(button.getAttribute('data-qty'), 10);

        switch (selected) {
            case 3:
                currlist = flwr3;
                document.getElementById("threeqty").style.display = 'block';
                document.getElementById("five_qty").style.display = 'none';
                document.getElementById("seven_qty").style.display = 'none';
                document.getElementById("ten_qty").style.display = 'none';
                document.getElementById("wrapper").style.transform = 'scale(0.7)';
                break;
            case 5:
                currlist = flwr5;
                document.getElementById("threeqty").style.display = 'block';
                document.getElementById("five_qty").style.display = 'block';
                document.getElementById("seven_qty").style.display = 'none';
                document.getElementById("ten_qty").style.display = 'none';
                document.getElementById("wrapper").style.transform = 'scale(0.9)';
                break;
            case 7:
                currlist = flwr7;
                document.getElementById("threeqty").style.display = 'block';
                document.getElementById("five_qty").style.display = 'block';
                document.getElementById("seven_qty").style.display = 'block';
                document.getElementById("ten_qty").style.display = 'none';
                document.getElementById("wrapper").style.transform = 'scale(0.96)';
                break;
            case 10:
                currlist = flwrs;
                document.getElementById("threeqty").style.display = 'block';
                document.getElementById("five_qty").style.display = 'block';
                document.getElementById("seven_qty").style.display = 'block';
                document.getElementById("ten_qty").style.display = 'block';
                document.getElementById("wrapper").style.transform = 'scale(1)';
                break;
            default:
                currlist = flwrs;
        }

        curr_flower = 0;
        update_flower();
    });
});
const updateFlowerSelection = (flower) => {
    let flowerElement = document.getElementById(flwrs[curr_flower].id);
    if (flowerElement) {
        flowerElement.style.backgroundImage = `url(${flower.image_url})`;
        flowerElement.style.display = "block";

        // Assuming each flower object has the following structure
        const flowerPrice = parseFloat(flower.price) || 0;
        const flowerQty = parseInt(flower.qty) || 1; // Default to 1 if not specified
        const product_id = parseInt(flower.product_id);

        window.curr_flower_price = flowerPrice;
        window.curr_total += flowerPrice;

        // Add the flower's price, quantity, and product ID to the selected_flowers array
        selected_flowers.push({
            product_id: product_id,
            name: flower.name,
            price: flowerPrice,
            qty: flowerQty,
            total_price: flowerPrice * flowerQty  // Calculate total price for this selection
        });
//         console.log('Selected flowers data:', selected_flowers);
// sessionStorage.setItem('selected_flowers', JSON.stringify(selected_flowers));

    //     console.log(JSON.stringify(selected_flowers)); // Check the data format before storing
    // sessionStorage.setItem('selected_flowers', JSON.stringify(selected_flowers));
    
       

    }

    // Store the updated selected_flowers array in sessionStorage
    console.log(JSON.stringify(selected_flowers)); // Check the data format before storing
    sessionStorage.setItem('selected_flowers', JSON.stringify(selected_flowers));
    

        sessionStorage.setItem('selected_flowers', JSON.stringify(selected_flowers));

        // Update session storage
        sessionStorage.setItem('curr_total', window.curr_total);
        sessionStorage.setItem('curr_flower_price', window.curr_flower_price);

        updateTotalPrice();
}

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

// Example flower click events
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

// Initialize session storage if it's empty
if (!sessionStorage.getItem('total')) {
    sessionStorage.setItem('total', '0'); // Set initial total to 0
}

// Function to store the total value in sessionStorage
const setTotal = (value) => {
    sessionStorage.setItem('total', value);
};

// Function to retrieve the total value from sessionStorage
const getTotal = () => {
    return parseFloat(sessionStorage.getItem('total')) || 0; // Default to 0 if not found
};

// Function to remove the total from sessionStorage
const removeTotal = () => {
    sessionStorage.removeItem('total');
};

// Example usage of storing the total when it's updated
const updateTotalPrice = () => {
    // Assume window.curr_total has the updated total amount
    let totalAmount = window.curr_total || 0; // Default to 0 if not available

    // Update sessionStorage with the new total
    setTotal(totalAmount);

    // Get the updated total from sessionStorage for further use
    const updatedTotal = getTotal();
    console.log('Updated Total from sessionStorage:', updatedTotal);

    // Display the total price in your UI
    const TotalPricespan = document.getElementById('ttl_');
    TotalPricespan.textContent = `₱${updatedTotal.toFixed(2)}`;
};

// Example usage to remove the total from sessionStorage when no longer needed
removeTotal();  // Call this when you want to remove the total from sessionStorage

// Call updateTotalPrice after selecting a flower
updateTotalPrice();
