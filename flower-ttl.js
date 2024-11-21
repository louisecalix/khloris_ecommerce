
//Total
let curr_total=0.0;
let curr_flower_price=0.0;
// 


const updateTotalPrice = () => {
    const TotalPricespan = document.getElementById('ttl_');

    // Get the current total value from #ttl_ (if it exists), or initialize to 0 if empty
    let existingTotal = parseFloat(TotalPricespan.textContent.replace('₱', '').replace(',', '').trim()) || 0;

    // Add the current flower price to the existing total
    let newTotal = existingTotal + curr_flower_price;

    // Update the displayed total price with proper formatting
    TotalPricespan.textContent = `₱${newTotal.toFixed(2)}`;
};

const getTotalPrice = () => {
    return curr_total.toFixed(2); // Return total as a string with two decimal places
};

export {getTotalPrice};