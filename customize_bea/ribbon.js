const DB = 'http://localhost/khloris_/fetching.php';
const Wrapper_cont = document.getElementById('rbbncont');

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

// Update the wrapper content - display all wrappers with type_id === '9'
const update_wrapper = (data) => {
    // Check if wrapper container exists
    if (!Wrapper_cont) {
        console.error("Wrapper container not found in the DOM.");
        return;
    }

    // Filter all wrappers with type_id === '9'
    const wrappers = data.filter(wrapper => wrapper.type_id === '9');
    console.log("All wrappers with type_id 9:", wrappers);

    // Loop through all matching wrappers and create individual divs
    wrappers.forEach(w => {
        const new_cont = document.createElement('div');
        
        // Set unique ID for each div based on the product_id
        new_cont.setAttribute('id', `ribbon-${w.product_id}`);
        new_cont.setAttribute('class', 'rbbn_frame');
        
        // Log the unique ID and image URL
        console.log(`Wrapper ID: wrapper-${w.product_id}`);
        console.log("Image URL:", w.image_url);
        
        // Set background image and size
        new_cont.style.backgroundImage = `url(${w.image_url})`;
        new_cont.style.width = '80px';  // Adjust to your desired size
        new_cont.style.height = '80px'; // Adjust to your desired size
        new_cont.style.backgroundSize = 'cover'; // Ensure the background fits the div

        // Append each wrapper to the container
        Wrapper_cont.appendChild(new_cont);
    });
};

// Main function to fetch data and update the UI
(async () => {
    const data = await getwrappers();
    console.log("Data received:", data);  // Log the data to ensure it's fetched
    update_wrapper(data);
})();
