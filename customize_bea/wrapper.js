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
        const new_cont = document.createElement('div');
        

        new_cont.setAttribute('id', `wrapper-${w.product_id}`);
        new_cont.setAttribute('class', 'wrrpr_frame');
        
   
        console.log(`Wrapper ID: wrapper-${w.product_id}`);
        console.log("Image URL:", w.image_url);
        
    
        new_cont.style.backgroundImage = `url(${w.image_url})`;
        new_cont.style.width = '80px';  
        new_cont.style.height = '80px';
        new_cont.style.backgroundSize = 'cover'; 
        new_cont.style.backgroundColor = 'white';

        Wrapper_cont.appendChild(new_cont);
    });
};

// Main function to fetch data and update the UI
(async () => {
    const data = await getwrappers();
    console.log("Data received:", data); 
    update_wrapper(data);
})();
