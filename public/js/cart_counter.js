// public/js/cart_counter.js
// Fungsi untuk update cart counter
function updateCartCounter() {
    // Menggunakan endpoint yang sudah ada di routes
    fetch(baseUrl + 'keranjang/count')
    .then(response => response.json())
    .then(data => {
        const cartCountElement = document.getElementById('cart-count');
        if (cartCountElement) {
            const count = data.count || 0;
            cartCountElement.textContent = count;
            cartCountElement.classList.add('loaded');
            
            // Show/hide counter based on count
            if (count > 0) {
                cartCountElement.style.display = 'flex';
                cartCountElement.classList.add('has-items');
            } else {
                cartCountElement.style.display = 'none';
                cartCountElement.classList.remove('has-items');
            }
        }
    })
    .catch(error => {
        console.error('Error updating cart counter:', error);
        const cartCountElement = document.getElementById('cart-count');
        if (cartCountElement) {
            cartCountElement.style.display = 'none';
        }
    });
}

// Auto-update cart counter when page loads
document.addEventListener('DOMContentLoaded', function() {
    updateCartCounter();
});

// Export function untuk digunakan di halaman lain
window.updateCartCounter = updateCartCounter;