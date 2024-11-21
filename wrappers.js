// Define the update_wtotal function first
let wrppr_prc = 0.0;

// Function to update the total price and return it
export const update_wtotal = (price) => {
    const numericPrice = parseFloat(price);

    if (isNaN(numericPrice)) {
        console.error("Invalid price value:", price);
        return 0; // Return 0 if the price is invalid
    }

    // Update the wrapper price
    wrppr_prc = numericPrice;

    const total = document.getElementById('ttl_');
    if (total) {
        total.textContent = `₱${wrppr_prc.toFixed(2)}`;
    } else {
        console.error("Element with id 'ttl_' not found.");
    }
    
    return wrppr_prc;
};

// Now define update_wrappers function which uses update_wtotal
export const update_wrappers = (data) => {
    const Wrapper_cont = document.getElementById('wrpprcont');
    const Wrapper = document.getElementById('wrapper');

    if (!Wrapper_cont) {
        console.error("Wrapper container not found in the DOM.");
        return;
    }

    const wrappers = data.filter(wrapper => wrapper.type_id === '9');
    console.log("Filtered wrappers:", wrappers);

    wrappers.forEach(w => {
        const wrapperDiv = document.createElement('div');
        wrapperDiv.classList.add('wrappers_');

        const img = document.createElement('img');
        img.src = w.image_url;
        img.alt = w.name || "Product Image";

        const name = document.createElement('span');
        name.textContent = w.name || "No Name Available";
        name.classList.add('name');
        name.style.backgroundColor = '#a2b378';

        wrapperDiv.addEventListener('click', () => {
            if (Wrapper) {
                Wrapper.style.backgroundImage = `url('${w.image_url}')`;
            } else {
                console.error("Wrapper element not found.");
            }

            // Update the wrapper price globally
            update_wtotal(w.price);

            // Store the wrapper data in sessionStorage
            sessionStorage.setItem('wrapper_price', w.price);
            sessionStorage.setItem('wrapper_name', w.name || 'No Name');
            sessionStorage.setItem('wrapper_product_id', w.product_id || 'No ID');

            console.log("Updated wrapper total:", wrppr_prc);
            console.log("Wrapper data stored in session:", w.name, w.price, w.product_id);
        });

        wrapperDiv.appendChild(img);
        wrapperDiv.appendChild(name);

        Wrapper_cont.appendChild(wrapperDiv);
    });
};
