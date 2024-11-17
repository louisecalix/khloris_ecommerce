const DB = 'http://localhost/khloris_/khloris_ecommerce/customize_bea/fetching.php';
const Ribbon_cont = document.getElementById('rbbncont');

// Fetch ribbon data
const getribbons = async () => {
    try {
        const response = await fetch(DB);
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

    const ribbons = data.filter(ribbon => ribbon.type_id === '10'); // Match actual type_id for ribbons
    console.log("Filtered ribbons:", ribbons);

    ribbons.forEach(r => {
        const ribbonDiv = document.createElement('div');
        ribbonDiv.setAttribute('id', `ribbon-${r.product_id}`);
        ribbonDiv.style.width = '9rem';
        ribbonDiv.style.height = '16rem';
        ribbonDiv.style.display = 'flex';
        ribbonDiv.style.flexDirection = 'column';
        ribbonDiv.style.alignItems = 'center';
        ribbonDiv.style.justifyContent = 'space-between';
        ribbonDiv.style.border = '1px solid #brown';
        ribbonDiv.style.backgroundColor = '#f7f4eb';
        ribbonDiv.style.padding = '6px';
        ribbonDiv.style.paddingTop = '4px';

        // Create image
        const img = document.createElement('img');
        img.src = r.image_url || 'fallback-image-url.jpg'; // Use a fallback if image_url is missing
        img.alt = r.name || "Product Image";
        img.style.width = '12rem';
        img.style.height = '14rem';
        img.style.objectFit = 'cover';

        // Create name
        const name = document.createElement('span');
        name.textContent = r.name || "No Name Available";
        name.style.marginTop = '3px';
        name.style.fontSize = '1.1rem';
        name.style.color = '#333';
        name.style.textAlign = 'center';

        ribbonDiv.appendChild(img);
        ribbonDiv.appendChild(name);

        Ribbon_cont.appendChild(ribbonDiv);
    });
};

// Fetch and update UI
(async () => {
    const data = await getribbons();
    console.log("Data received:", data);
    update_ribbons(data);
})();
