const DB = 'http://localhost/khloris_/khloris_ecommerce/customize_bea/fetching.php';
const Wrapper_cont = document.getElementById('wrpprcont');

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
};const update_wrapper = (data) => {
    if (!Wrapper_cont) {
        console.error("Wrapper container not found in the DOM.");
        return;
    }

    const wrappers = data.filter(wrapper => wrapper.type_id === '9'); // Match actual type_id
    console.log("Filtered wrappers:", wrappers);

    wrappers.forEach(w => {
        const wrapperDiv = document.createElement('div');
        wrapperDiv.setAttribute('id', `wrapper-${w.product_id}`);
        wrapperDiv.style.width = '9rem';
        wrapperDiv.style.height = '16rem';
        wrapperDiv.style.display = 'flex';
        wrapperDiv.style.flexDirection = 'column';
        wrapperDiv.style.alignItems = 'center';
        wrapperDiv.style.justifyContent = 'space-between';
        wrapperDiv.style.border = '1px solid #brown';
        wrapperDiv.style.backgroundColor = '#f7f4eb';
        wrapperDiv.style.padding = '6px';
        wrapperDiv.style.paddingTop = '4px';

        // Create image
        const img = document.createElement('img');
        img.src = w.image_url || 'fallback-image-url.jpg'; // Use a fallback if image_url is missing
        img.alt = w.name || "Product Image";
        img.style.width = '12rem';
        img.style.height = '14rem';
        img.style.objectFit = 'cover';

        // Create name
        const name = document.createElement('span');
        name.textContent = w.name || "No Name Available";
        name.style.marginTop = '3px';
        name.style.fontSize = '1.1rem';
        name.style.color = '#333';
        name.style.textAlign = 'center';

        wrapperDiv.appendChild(img);
        wrapperDiv.appendChild(name);

        Wrapper_cont.appendChild(wrapperDiv);
    });
};

// Fetch and update UI
(async () => {
    const data = await getwrappers();
    console.log("Data received:", data);
    update_wrapper(data);
})();
