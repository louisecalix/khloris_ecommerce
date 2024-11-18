const DB = 'http://localhost/khloris_/khloris_ecommerce/customize_bea/fetching.php';
const Wrapper_cont = document.getElementById('wrpprcont');
const Wrapper = document.getElementById('wrapper'); 


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


const update_wrappers = (data) => {
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
        img.src = w.image_url 
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
            update_wtotal(w.price)
            return {id: w.product_id, prc: w.price};
        });

      
        wrapperDiv.appendChild(img);
        wrapperDiv.appendChild(name);

       
        Wrapper_cont.appendChild(wrapperDiv);
    });
};

let wrppr_prc = 0.0;


const update_wtotal = (price) => {
   
    const numericPrice = parseFloat(price);

    if (isNaN(numericPrice)) {
        console.error("Invalid price value:", price);
        return; 
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


(async () => {
    const data = await getwrappers();
    console.log("Data received:", data);
    update_wrappers(data);
})();
