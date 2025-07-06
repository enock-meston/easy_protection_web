{{-- Add this CSS to your main stylesheet or in a <style> block --}}
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .order-summary-container {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 20px;
    }

    .order-summary-card {
        max-width: 600px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .order-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 32px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .order-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .order-header h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 8px;
        position: relative;
        z-index: 1;
    }

    .order-header .subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        position: relative;
        z-index: 1;
    }

    .order-content {
        padding: 40px;
    }

    .cart-items {
        margin-bottom: 32px;
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
    }

    .cart-item:hover {
        background: rgba(102, 126, 234, 0.03);
        transform: translateX(8px);
        border-radius: 12px;
        padding-left: 16px;
        padding-right: 16px;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .item-info {
        flex: 1;
    }

    .item-name {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 4px;
    }

    .item-details {
        font-size: 0.95rem;
        color: #718096;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .quantity-badge {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .item-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d3748;
        text-align: right;
    }

    .empty-cart {
        text-align: center;
        padding: 60px 20px;
        color: #718096;
    }

    .empty-cart i {
        font-size: 4rem;
        color: #e2e8f0;
        margin-bottom: 16px;
    }

    .total-section {
        background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
        padding: 32px;
        border-radius: 20px;
        margin-bottom: 32px;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .total-breakdown {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        color: #4a5568;
    }

    .total-final {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
        padding-top: 16px;
        border-top: 2px solid rgba(102, 126, 234, 0.2);
    }

    .order-button {
        width: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 18px 32px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .order-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .order-button:hover::before {
        left: 100%;
    }

    .order-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
    }

    .order-button:active {
        transform: translateY(0);
    }

    .security-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 20px;
        color: #718096;
        font-size: 0.9rem;
    }

    .security-badge i {
        color: #48bb78;
    }

    @media (max-width: 640px) {
        .order-summary-card {
            margin: 10px;
            border-radius: 16px;
        }

        .order-header {
            padding: 24px;
        }

        .order-header h2 {
            font-size: 2rem;
        }

        .order-content {
            padding: 24px;
        }

        .cart-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .item-price {
            text-align: left;
        }
    }
</style>

{{-- Add Font Awesome CDN to your layout --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="order-summary-container">
    <div class="order-summary-card">
        <div class="order-header">
            <h2><i class="fas fa-shopping-cart"></i> Order Summary</h2>
            <div class="subtitle">Review your items before checkout</div>
        </div>

        <div class="order-content">
            <div class="cart-items">
                @forelse ($cart as $item)
                    <div class="cart-item">
                        <div class="item-info">
                            <div class="item-name">{{ $item['name'] }}</div>
                            <div class="item-details">
                                <span class="quantity-badge">{{ $item['quantity'] }}x</span>
                                <span>Unit: {{ number_format($item['price']) }} RWF</span>
                            </div>
                        </div>
                        <div class="item-price">{{ number_format($item['price'] * $item['quantity']) }} RWF</div>
                    </div>
                @empty
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <h3>Your cart is empty</h3>
                        <p>Add some items to get started</p>
                    </div>
                @endforelse
            </div>

            @if(!empty($cart))
                <div class="total-section">
                     <div class="total-breakdown">
                        <span>Client Name:</span>
                        <span>{{ $myName }} RWF</span>
                    </div>
                    <div class="total-breakdown">
                        <span>CLient email:</span>
                        <span>{{ $myEmail }}</span>
                    </div>
                    <div class="total-breakdown">
                        <span>CLient Phone Number:</span>
                        <span>{{ $myPhone }}</span>
                    </div>

                    <div class="total-breakdown">
                        <span>Subtotal:</span>
                        <span>{{ number_format($total) }}</span>
                    </div>

                    <div class="total-breakdown">
                        <span>Delivery Fee:</span>
                        <span>{{ ($total/10) }} RWF</span>
                    </div>
                    <div class="total-final">
                        <span>Total:</span>
                        <span>{{ number_format($total + ($total/10)) }} RWF</span>
                    </div>
                </div>

                <form action="{{ route('place.order') }}" method="POST">
                    @csrf
                    <button type="submit" class="order-button">
                        <i class="fas fa-credit-card"></i>
                        Place Order Securely
                    </button>
                </form>

                <div class="security-badge">
                    <i class="fas fa-shield-alt"></i>
                    <span>Secure checkout powered by SSL encryption</span>
                </div>
            @endif
        </div>
    </div>
</div>
