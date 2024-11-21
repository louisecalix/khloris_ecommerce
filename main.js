import { update_total } from "./ribbon-update.js";
import { update_wtotal } from "./wrappers.js";

let totalPrice = 0.0;

const updateTotalPrice = () => {
    const TotalPricespan = document.getElementById('ttl_');

    // Get the current total value from #ttl_ (if it exists), or initialize to 0 if empty
    let existingTotal = parseFloat(TotalPricespan.textContent.replace('₱', '').replace(',', '').trim()) || 0;

    // Retrieve prices from window object
    let rp = window.rbbn_prc || 50;  // Default to 0 if not defined
    let wp = window.wrppr_prc || 70;  
    console.log(rp);
    console.log(wp);
  

    // Add the current flower price, wrapper price, and ribbon price
    totalPrice = window.curr_total + rp + wp;

    // Update the displayed total price with proper formatting
    TotalPricespan.textContent = `₱${totalPrice.toFixed(2)}`;
};
