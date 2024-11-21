// customize.js

import { update_wrappers} from './wrappers.js';

const DB = 'http://localhost/khloris_ecommerce/customize_bea/fetching.php';

// Function to fetch wrapper data
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

// Fetch the wrapper data and update the UI
(async () => {
    const data = await getwrappers();
    console.log("Data received:", data);
    update_wrappers(data);  // Calls the function from wrapper.js to update the UI
})();


