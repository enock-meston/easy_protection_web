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
                                li.innerHTML = `<strong>${item.name}</strong> - ${item.quantity} x ${item.price} RWF`;
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

</body>

</html>
