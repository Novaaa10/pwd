document.addEventListener('DOMContentLoaded', function() {
    // Initialize cart if not exists
    initializeCart();
    
    // Setup event listeners
    setupSearchFunctionality();
    setupAddToCartButtons();
    setupSmoothScrolling();
    setupHeaderScrollEffect();
    updateCartCount();
});

function initializeCart() {
    if (!localStorage.getItem('cart')) {
        localStorage.setItem('cart', JSON.stringify([]));
    }
}

function setupSearchFunctionality() {
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.querySelector('.search-box button');
    
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchProduct();
            }
        });
    }
    
    if (searchButton) {
        searchButton.addEventListener('click', searchProduct);
    }
}

function searchProduct() {
    const searchTerm = document.getElementById('searchInput').value.trim();
    if (searchTerm) {
        // In a real implementation, this would fetch from server
        console.log('Searching for:', searchTerm);
        alert(`Search functionality would look for: ${searchTerm}`);
        // For actual implementation:
        // fetch(`search.php?q=${encodeURIComponent(searchTerm)}`)
        //     .then(response => response.json())
        //     .then(data => displayResults(data))
        //     .catch(error => console.error('Error:', error));
    } else {
        alert('Please enter a search term');
    }
}

function displayResults(products) {
    // Implementation for displaying search results
    console.log('Displaying results:', products);
}

function setupAddToCartButtons() {
    document.querySelectorAll('.btn-add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productItem = this.closest('.produk-item');
            const productName = productItem.querySelector('h3').textContent;
            const productPrice = productItem.querySelector('.product-price').textContent;
            const productImage = productItem.querySelector('img').src;
            
            addToCart({
                name: productName,
                price: productPrice,
                image: productImage
            });
            
            // Visual feedback
            showAddToCartFeedback(this);
        });
    });
}

function addToCart(product) {
    try {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const existingItem = cart.find(item => item.name === product.name);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                ...product,
                quantity: 1,
                addedAt: new Date().toISOString()
            });
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
    } catch (error) {
        console.error('Error adding to cart:', error);
        alert('Failed to add item to cart. Please try again.');
    }
}

function showAddToCartFeedback(button) {
    const originalText = button.innerHTML;
    const originalBgColor = button.style.backgroundColor;
    
    button.innerHTML = '<i class="fas fa-check"></i> Ditambahkan';
    button.style.backgroundColor = '#4CAF50';
    
    setTimeout(() => {
        button.innerHTML = originalText;
        button.style.backgroundColor = originalBgColor;
    }, 2000);
}

function updateCartCount() {
    try {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
        const cartIcon = document.querySelector('.fa-shopping-cart');
        
        if (cartIcon) {
            // Create or update cart count badge
            let countBadge = cartIcon.parentElement.querySelector('.cart-count-badge');
            
            if (!countBadge) {
                countBadge = document.createElement('span');
                countBadge.className = 'cart-count-badge';
                cartIcon.parentElement.appendChild(countBadge);
            }
            
            if (totalItems > 0) {
                countBadge.textContent = totalItems;
                countBadge.style.display = 'block';
            } else {
                countBadge.style.display = 'none';
            }
        }
    } catch (error) {
        console.error('Error updating cart count:', error);
    }
}

function setupSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
}

function setupHeaderScrollEffect() {
    const header = document.querySelector('.main-header');
    if (!header) return;
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        } else {
            header.style.boxShadow = 'none';
        }
    });
}

// Add this CSS for the cart badge
const style = document.createElement('style');
style.textContent = `
    .cart-count-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: var(--primary);
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        display: none;
    }
    
    .account-icons {
        position: relative;
    }
    
    .account-icons a {
        position: relative;
    }
`;
document.head.appendChild(style);