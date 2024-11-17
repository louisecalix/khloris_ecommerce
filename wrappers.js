const DB = 'http://localhost/khloris_/khloris_ecommerce/customize_bea/fetching.php';
const Wrapper_cont = document.getElementById('wrpprcont');
const Wrapper = document.getElementById('wrapper'); // Get the #wrapper element

// Fetch wrapper data
const getwrappers = async () => {
    try {
        const response = await fetch(DB);
        const data = await response.json();
        return data;
    } catch (e) {
        alert(`Error fetching data: ${e.message}`);
        return [];
    }
};

// Update wrappers
const update_wrappers = (data) => {
    if (!Wrapper_cont) {
        console.error("Wrapper container not found in the DOM.");
        return;
    }

    const wrappers = data.filter(wrapper => wrapper.type_id === '9'); 
    console.log("Filtered wrappers:", wrappers);

    wrappers.forEach(w => {
        // Create wrapper element
        const wrapperDiv = document.createElement('div');
        wrapperDiv.classList.add('wrappers_'); // Add the correct CSS class

        // Create image element
        const img = document.createElement('img');
        img.src = w.image_url ; // Fallback image
        img.alt = w.name || "Product Image";

        // Create name element
        const name = document.createElement('span');
        name.textContent = w.name || "No Name Available";
        name.classList.add('name');
        name.style.backgroundColor = '#a2b378';

        // Set click event on the wrapperDiv to change the background of #wrapper
        wrapperDiv.addEventListener('click', () => {
            if (Wrapper) {
                Wrapper.style.backgroundImage = `url('${w.image_url}')`;
            } else {
                console.error("Wrapper element not found.");
            }
            update_wtotal(w.price)
            return {id: w.product_id, prc: w.price};
        });

        // Append children to wrapper div
        wrapperDiv.appendChild(img);
        wrapperDiv.appendChild(name);

        // Append wrapper to the container
        Wrapper_cont.appendChild(wrapperDiv);
    });
};

let wrppr_prc = 0.0;


const update_wtotal = (price) => {
    // Ensure price is a valid number
    const numericPrice = parseFloat(price);

    if (isNaN(numericPrice)) {
        console.error("Invalid price value:", price);
        return; // Exit the function if the price is invalid
    }

    wrppr_prc = numericPrice;

    const total = document.getElementById('ttl_');
    if (total) {
        total.textContent = `₱${wrppr_prc.toFixed(2)}`;
    } else {
        console.error("Element with id 'ttl_' not found.");
    }

    return wrppr_prc;
};

// Fetch and update UI
(async () => {
    const data = await getwrappers();
    console.log("Data received:", data);
    update_wrappers(data);
})();
