console.log("Website loaded successfully!");

document.addEventListener("DOMContentLoaded", function() {
    const cartCount = document.getElementById('cart-count');
    const storedCount = localStorage.getItem('cartCount');
    if (storedCount) {
        cartCount.textContent = storedCount;
    }
    else{
        cartCount.textContent = 0;
    }
});



function updateCartCount() {
    const cartCount = document.getElementById('cart-count');
    let count = parseInt(cartCount.textContent);
    cartCount.textContent = count + 1;
    localStorage.setItem('cartCount', cartCount.textContent);
}

