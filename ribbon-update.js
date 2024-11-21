// ribbons-update.js
import { getribbons } from './customize2.js'; // Import ribbons data function

// Elements from the DOM
const Ribbon_cont = document.getElementById('rbbncont');
const Ribbon = document.getElementById('ribbon_');

// Global variable for the ribbon price
let rbbn_prc = 0.0;

// Function to update the total
const update_total = (price) => {
    // Ensure price is a valid number
    const numericPrice = parseFloat(price);

    if (isNaN(numericPrice)) {
        console.error("Invalid price value:", price);
        return; // Exit the function if the price is invalid
    }

    window.rbbn_prc = numericPrice;

    const total = document.getElementById('ttl_');
    if (total) {
        total.textContent = `₱${rbbn_prc.toFixed(2)}`;
    } else {
        console.error("Element with id 'ttl_' not found.");
    }

    return window.rbbn_prc;
};

// Function to update the ribbons UI
const update_ribbons = (data) => {
    if (!Ribbon_cont) {
        console.error("Ribbon container not found in the DOM.");
        return;
    }

    const ribbons = data.filter(ribbon => ribbon.type_id === '10'); // Filter ribbons
    console.log("Filtered ribbons:", ribbons);

    ribbons.forEach(r => {
        const ribbonDiv = document.createElement('div');
        ribbonDiv.classList.add('ribbon');
        ribbonDiv.setAttribute('id', `ribbon-${r.product_id}`);

        // Create image
        const img = document.createElement('img');
        img.src = r.image_url;
        img.alt = r.name || "Product Image";

        // Create name
        const name = document.createElement('span');
        name.textContent = r.name || "No Name Available";
        name.classList.add('name');

        ribbonDiv.addEventListener('click', () => {
            if (Ribbon) {
                Ribbon.style.backgroundImage = `url(${r.image_url})`;
            } else {
                console.error("Ribbon element not found.");
            }
            console.log("Ribbon clicked with Product ID:", r.product_id);
            console.log("Ribbon clicked with Price:", r.price);
            update_total(r.price); // Update the total when a ribbon is selected

            // Store ribbon data in sessionStorage
            sessionStorage.setItem('ribbon_price', r.price);
            sessionStorage.setItem('ribbon_name', r.name || 'No Name');
            sessionStorage.setItem('ribbon_product_id', r.product_id || 'No ID');

            console.log("Ribbon data stored in session:", r.name, r.price, r.product_id);
        });

        ribbonDiv.appendChild(img);
        ribbonDiv.appendChild(name);
        Ribbon_cont.appendChild(ribbonDiv);
    });
};

// Fetch ribbon data and update the UI
(async () => {
    const data = await getribbons();
    console.log("Data received:", data);
    update_ribbons(data);
})();

// Export the update_ribbons function for use in other modules
export { rbbn_prc, update_total };
