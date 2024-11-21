// ribbons-fetch.js
const BD = 'http://localhost/khloris_/khloris_ecommerce/customize_bea/fetching.php';


const getribbons = async () => {
    try {
        const response = await fetch(BD);
        const data = await response.json();
        return data;
    } catch (e) {
        alert(`Error fetching data: ${e.message}`);
        return [];
    }
};


export { getribbons };
