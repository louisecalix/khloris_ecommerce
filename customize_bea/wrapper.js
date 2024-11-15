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
};



const update_wrapper = (data) => {
    if (!Wrapper_cont) {
        console.error("Wrapper container not found in the DOM.");
        return;
    }

    const wrappers = data.filter(wrapper => wrapper.type_id === '9');
    console.log("All wrappers with type_id 9:", wrappers);


    wrappers.forEach(w => {
        const wrapperDiv = document.createElement('div');
        wrapperDiv.setAttribute('id', `wrapper-${w.product_id}`);
        wrapperDiv.style.width = '100px';
        wrapperDiv.style.height = '100px';
        wrapperDiv.style.display = 'flex';
        wrapperDiv.style.alignItems = 'center';
        wrapperDiv.style.justifyContent = 'center';
        wrapperDiv.style.border = '1px solid #ccc';
        wrapperDiv.style.backgroundColor = 'white';
        wrapperDiv.style.padding = '10px';
        wrapperDiv.style.paddingTop = '24px';

        console.log(`Wrapper ID: wrapper-${w.product_id}`);
        console.log("Image URL:", w.image_url);

        // Create img element
        const img = document.createElement('img');
        img.src = w.image_url;
        img.style.width = '90px';
        img.style.height = '90px';
        img.style.objectFit = 'cover'; // Ensures image fits within given dimensions

        // Append img to the div
        wrapperDiv.appendChild(img);

        Wrapper_cont.appendChild(wrapperDiv);
    });
};

// Main function to fetch data and update the UI
(async () => {
    const data = await getwrappers();
    console.log("Data received:", data); 
    update_wrapper(data);
})();
