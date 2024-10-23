const DB = 'http://localhost/khloris_/khloris_ecommerce/customize_bea/fetching.php';
const Ribbon_cont = document.getElementById('rbbncont');


const getribbon = async () => {
    try {
        const response = await fetch(DB);
        const data = await response.json();
        return data;
    } catch (e) {
        alert(`Error fetching data: ${e.message}`);
        return [];
    }
};

const update_ribbon = (data) => {
  
    if (!Ribbon_cont) {
        console.error("Ribbon container not found in the DOM.");
        return;
    }


    const ribbons = data.filter(ribbon => ribbon.type_id === '10');
    console.log("All wrappers with type_id 10:", ribbons);

 
    ribbons.forEach(w => {
        const new_cont = document.createElement('div');
        
        
        new_cont.setAttribute('id', `ribbon-${w.product_id}`);
        new_cont.setAttribute('class', 'rbbn_frame');
    
        console.log(`Wrapper ID: ribbon-${w.product_id}`);
        console.log("Image URL:", w.image_url);
        
  
        new_cont.style.backgroundImage = `url(${w.image_url})`;
        new_cont.style.width = '80px';  
        new_cont.style.height = '80px';
        new_cont.style.backgroundSize = 'cover'; 

       
        Ribbon_cont.appendChild(new_cont);
    });
};

(async () => {
    const data =  getribbon();
    console.log("Data received:", data);
    update_ribbon(data);
})();
