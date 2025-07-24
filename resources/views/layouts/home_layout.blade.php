<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="turbo-cache-control" content="no-preview">

    <title>Easy Protection</title>
    {{-- app icon --}}

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .hero-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        }

        .category-hover {
            transition: all 0.3s ease;
        }

        .category-hover:hover {
            transform: scale(1.05);
        }

        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.open {
            transform: translateX(0);
        }

        .hero-text {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .feature-icon {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
        }

        .testimonial-card {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-slide-in {
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /*  */
/* Enhanced mobile menu styles */
.mobile-menu {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Enhanced Custom scrollbar for mobile menu */
.mobile-menu::-webkit-scrollbar {
    width: 6px;
}

.mobile-menu::-webkit-scrollbar-track {
    background: rgba(243, 244, 246, 0.5);
    border-radius: 3px;
    margin: 8px 0;
}

.mobile-menu::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #93c5fd, #3b82f6);
    border-radius: 3px;
    box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.1);
}

.mobile-menu::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #60a5fa, #2563eb);
}

/* Scrollbar for cart items list */
#mobile-cart-items-list::-webkit-scrollbar {
    width: 4px;
}

#mobile-cart-items-list::-webkit-scrollbar-track {
    background: rgba(243, 244, 246, 0.3);
    border-radius: 2px;
}

#mobile-cart-items-list::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 2px;
}

#mobile-cart-items-list::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Smooth scrolling behavior */
.mobile-menu {
    scroll-behavior: smooth;
}

/* Enhanced scroll indicators */
.mobile-menu::before {
    content: '';
    position: sticky;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(59, 130, 246, 0.3), transparent);
    z-index: 10;
}

.mobile-menu::after {
    content: '';
    position: sticky;
    bottom: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(59, 130, 246, 0.3), transparent);
    z-index: 10;
}

/* Focus states for accessibility */
.mobile-menu a:focus,
.mobile-menu button:focus {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
    border-radius: 12px;
}

/* Smooth hover effects */
.mobile-menu .group:hover {
    transform: translateY(-1px);
}
    </style>
</head>

<body class="bg-gray-50" x-data="{ mobileMenuOpen: false }">
    <livewire:navigation-menu />

    <main>
        {{ $slot }}
    </main>

    @include('layouts.includes.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Buy now
            const buyNowBtn = document.getElementById('buy-now');
            if (buyNowBtn) {
                buyNowBtn.addEventListener('click', () => {
                    fetch('/check-auth')
                        .then(res => res.json())
                        .then(data => {
                            if (data.loggedIn) {
                                window.location.href = '/buy';
                            } else {
                                window.location.href = '/login';
                            }
                        });
                });
            }

            // Quantity controls
            let quantity = 1;
            const increaseBtn = document.getElementById('increase');
            const decreaseBtn = document.getElementById('decrease');
            const qtySpan = document.getElementById('qty');
            if (increaseBtn && qtySpan) {
                increaseBtn.addEventListener('click', () => {
                    quantity++;
                    qtySpan.innerText = quantity;
                });
            }
            if (decreaseBtn && qtySpan) {
                decreaseBtn.addEventListener('click', () => {
                    if (quantity > 1) {
                        quantity--;
                        qtySpan.innerText = quantity;
                    }
                });
            }

            // Load cart count
            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
                fetch('/cart-count')
                    .then(res => res.json())
                    .then(data => {
                        cartCount.innerText = data.count;
                    });
            }

            // Load and display cart items
            function loadCartItems() {
                const list = document.getElementById('cart-items-list');
                const cartTotal = document.getElementById('cart-total');
                if (!list || !cartTotal) return;
                fetch('/cart-items')
                    .then(res => res.json())
                    .then(data => {
                        list.innerHTML = '';
                        if (data.items.length === 0) {
                            list.innerHTML = '<li class="text-gray-500">Your cart is empty.</li>';
                            cartTotal.innerText = 'Total: 0 RWF';
                        } else {
                            let total = 0;
                            data.items.forEach(item => {
                                total += item.price * item.quantity;
                                const li = document.createElement('li');
                                li.className = 'border-b pb-2 text-sm text-gray-800';
                                li.innerHTML =
                                    `<strong>${item.name}</strong> - ${item.quantity} x ${item.price} RWF`;
                                list.appendChild(li);
                            });
                            cartTotal.innerText = `Total: ${total} RWF`;
                        }
                    });
            }

            // Toggle dropdown
            const toggleCart = document.getElementById('toggle-cart');
            const cartDropdown = document.getElementById('cart-dropdown');
            if (toggleCart && cartDropdown) {
                toggleCart.addEventListener('click', function() {
                    cartDropdown.classList.toggle('hidden');
                });
            }

            // Clear cart
            const clearCart = document.getElementById('clear-cart');
            if (clearCart) {
                clearCart.addEventListener('click', () => {
                    fetch('/clear-cart', {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success && cartCount) {
                                cartCount.innerText = '0';
                                loadCartItems();
                            }
                        });
                });
            }

            // Close cart
            const closeCart = document.getElementById('close-cart');
            if (closeCart && cartDropdown) {
                closeCart.addEventListener('click', () => {
                    cartDropdown.classList.add('hidden');
                });
            }

            // Add to cart
            const addToCartBtn = document.getElementById('addToCartBtn');
            if (addToCartBtn) {
                addToCartBtn.addEventListener('click', () => {
                    const productId = addToCartBtn.getAttribute('data-product-id');
                    fetch('/add-to-cart', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                quantity: quantity
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success && cartCount) {
                                cartCount.innerText = data.cart_count;
                                loadCartItems();
                            }
                        });
                });
            }

            // Initial load of cart items if cart exists
            if (document.getElementById('cart-items-list')) {
                loadCartItems();
            }
        });
    </script>


{{-- //mobile --}}

    <script>
// Sync cart functionality between desktop and mobile
document.addEventListener('DOMContentLoaded', function() {
    const desktopCartCount = document.getElementById('cart-count');
    const mobileCartCount = document.getElementById('mobile-cart-count');
    const desktopCartItems = document.getElementById('cart-items-list');
    const mobileCartItems = document.getElementById('mobile-cart-items-list');
    const desktopCartTotal = document.getElementById('cart-total');
    const mobileCartTotal = document.getElementById('mobile-cart-total');

    // Function to sync cart data
    function syncCartData() {
        if (desktopCartCount && mobileCartCount) {
            mobileCartCount.textContent = desktopCartCount.textContent;
        }
        if (desktopCartItems && mobileCartItems) {
            mobileCartItems.innerHTML = desktopCartItems.innerHTML;
        }
        if (desktopCartTotal && mobileCartTotal) {
            mobileCartTotal.textContent = desktopCartTotal.textContent;
        }
    }

    // Mobile cart toggle
    const mobileToggleCart = document.getElementById('mobile-toggle-cart');
    const mobileCartDropdown = document.getElementById('mobile-cart-dropdown');
    const mobileCloseCart = document.getElementById('mobile-close-cart');

    if (mobileToggleCart && mobileCartDropdown) {
        mobileToggleCart.addEventListener('click', function() {
            syncCartData(); // Sync data before showing
            mobileCartDropdown.classList.toggle('hidden');
        });
    }

    if (mobileCloseCart && mobileCartDropdown) {
        mobileCloseCart.addEventListener('click', function() {
            mobileCartDropdown.classList.add('hidden');
        });
    }

    // Mobile cart clear and buy buttons
    const mobileClearCart = document.getElementById('mobile-clear-cart');
    const mobileBuyNow = document.getElementById('mobile-buy-now');
    const desktopClearCart = document.getElementById('clear-cart');
    const desktopBuyNow = document.getElementById('buy-now');

    if (mobileClearCart && desktopClearCart) {
        mobileClearCart.addEventListener('click', function() {
            desktopClearCart.click(); // Trigger desktop functionality
            syncCartData(); // Sync after clearing
        });
    }

    if (mobileBuyNow && desktopBuyNow) {
        mobileBuyNow.addEventListener('click', function() {
            desktopBuyNow.click(); // Trigger desktop functionality
        });
    }

    // Observe changes in desktop cart to sync with mobile
    if (desktopCartCount) {
        const observer = new MutationObserver(syncCartData);
        observer.observe(desktopCartCount, { childList: true, subtree: true });
    }
});
</script>
</body>

</html>
