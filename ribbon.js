const BD = 'http://localhost/khloris_/khloris_ecommerce/customize_bea/fetching.php';
const Ribbon_cont = document.getElementById('rbbncont');
const Ribbon = document.getElementById('ribbon_');


const getribbons = async () => {
    try {
        const response = await fetch(BD);
        const data = await response.json();
        return data;
    } catch (e) {
        alert(`Error fetching data: ${e.message}`);
        return [];
    }
};

const update_ribbons = (data) => {
    if (!Ribbon_cont) {
        console.error("Ribbon container not found in the DOM.");
        return;
    }

    const ribbons = data.filter(ribbon => ribbon.type_id === '10'); 
    console.log("Filtered ribbons:", ribbons);

    ribbons.forEach(r => {
        const ribbonDiv = document.createElement('div');
        ribbonDiv.classList.add('ribbon');
        ribbonDiv.setAttribute('id', `ribbon-${r.product_id}`);

        // Create image
        const img = document.createElement('img');
        img.src = r.image_url ;// Use a fallback if image_url is missing
        img.alt = r.name || "Product Image";

        // Create name
        const name = document.createElement('span');
        name.textContent = r.name || "No Name Available";
        name.classList.add('name');

        ribbonDiv.addEventListener('click', () =>{
            if (Ribbon){
                Ribbon.style.backgroundImage = `url(${r.image_url})`
            }else {
                console.error("Ribbon element not found.");
            }
            console.log("Ribbon clicked with Product ID:", r.product_id);
            console.log("Ribbon clicked with Product ID:", r.price);
            update_total(r.price)
            return {id: r.product_id, prc: r.price};
        });

        ribbonDiv.appendChild(img);
        ribbonDiv.appendChild(name);

        Ribbon_cont.appendChild(ribbonDiv);
    });
};

let rbbn_prc = 0.0;

const update_total = (price) => {
    // Ensure price is a valid number
    const numericPrice = parseFloat(price);

    if (isNaN(numericPrice)) {
        console.error("Invalid price value:", price);
        return; // Exit the function if the price is invalid
    }

    rbbn_prc = numericPrice;

    const total = document.getElementById('ttl_');
    if (total) {
        total.textContent = `₱${rbbn_prc.toFixed(2)}`;
    } else {
        console.error("Element with id 'ttl_' not found.");
    }

    return rbbn_prc;
};




(async () => {
    const data = await getribbons();
    console.log("Data received:", data);
    update_ribbons(data);
    
})();


// export default update_total;
