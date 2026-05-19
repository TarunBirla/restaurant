@extends('front.layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    .co-page {
        background: #F4F3EF;
        min-height: 100vh;
        font-family: 'DM Sans', sans-serif;
        padding: 40px 20px 80px;
    }

    .co-wrap {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 420px;
        gap: 28px;
        align-items: start;
    }

    /* ---- LEFT PANEL ---- */
    .co-left { display: flex; flex-direction: column; gap: 20px; }

    .co-card {
        background: #fff;
        border-radius: 24px;
        padding: 28px 32px;
        border: 1px solid #E8E6E0;
    }

    .co-card-title {
        font-family: 'Syne', sans-serif;
        font-size: 17px;
        font-weight: 700;
        color: #111;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .co-card-title .step-num {
        width: 28px; height: 28px;
        background: #E63946;
        color: #fff;
        border-radius: 50%;
        font-size: 13px;
        font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    /* ---- ORDER ITEMS ---- */
    .co-item {
        display: flex;
        gap: 16px;
        padding: 18px 0;
        border-bottom: 1px solid #F0EEE9;
    }
    .co-item:last-child { border-bottom: none; padding-bottom: 0; }
    .co-item:first-child { padding-top: 0; }

    .co-item-img {
        width: 120px; height: 120px;
        border-radius: 16px;
        object-fit: cover;
        flex-shrink: 0;
        border: 1px solid #F0EEE9;
    }

    .co-item-body { flex: 1; min-width: 0; }

    .co-item-name {
        /* font-family: 'Syne', sans-serif; */
        font-size: 16px;
        font-weight: 700;
        color: #111;
        margin-bottom: 6px;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }

    .co-item-badges { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 10px; }

    .badge-offer {
        background: #FFF0EC;
        color: #E63946;
        border: 1px solid #FECACA;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }
    .badge-discount {
        background: #F0FDF4;
        color: #16A34A;
        border: 1px solid #BBF7D0;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }
    .badge-save {
        background: #FFFBEB;
        color: #B45309;
        border: 1px solid #FDE68A;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .co-item-price-row {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .price-old { color: #9CA3AF; text-decoration: line-through; font-size: 14px; }
    .price-new { color: #E63946; font-size: 18px; font-weight: 700;  }
    .price-normal { color: #E63946; font-size: 18px; font-weight: 700;  }

    /* QTY CONTROLS */
    .qty-controls {
        display: flex;
        align-items: center;
        gap: 0;
        border: 1.5px solid #E8E6E0;
        border-radius: 12px;
        overflow: hidden;
        width: fit-content;
        margin-top: 10px;
    }
    .qty-btn {
        width: 34px; height: 34px;
        display: flex; align-items: center; justify-content: center;
        text-decoration: none;
        font-size: 18px; font-weight: 700;
        transition: background 0.2s;
        color: #111;
    }
    .qty-btn.minus { background: #F4F3EF; }
    .qty-btn.plus  { background: #E63946; color: #fff; }
    .qty-btn.minus:hover { background: #E8E6E0; }
    .qty-btn.plus:hover  { background: #c42d0b; }
    .qty-num {
        min-width: 38px;
        text-align: center;
        font-size: 15px;
        font-weight: 700;
        color: #111;
        border-left: 1px solid #E8E6E0;
        border-right: 1px solid #E8E6E0;
        height: 34px;
        line-height: 34px;
    }
    .co-item-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-between;
        min-width: 100px;
    }
    .co-item-subtotal {
        /* font-family: 'Syne', sans-serif; */
        font-size: 20px;
        font-weight: 700;
        color: #111;
    }
    .co-item-subtotal-label {
        font-size: 11px;
        color: #9CA3AF;
        font-weight: 500;
        margin-bottom: 2px;
    }
    .co-remove-btn {
        color: #9CA3AF;
        font-size: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }
    .co-remove-btn:hover { color: #E63946; }

    /* ---- ORDER TYPE ---- */
    .order-type-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

    .ot-label {
        border: 2px solid #E8E6E0;
        border-radius: 18px;
        padding: 18px 20px;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .ot-label:hover { border-color: #E63946; background: #FFF5F5; }
    .ot-label input[type=radio] { display: none; }
    .ot-label.checked { border-color: #E63946; background: #FFF5F5; }

    .ot-icon {
        width: 46px; height: 46px;
        border-radius: 14px;
        background: #F4F3EF;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
        transition: background 0.2s;
    }
    .ot-label.checked .ot-icon { background: #FECACA; }
    .ot-title { font-size: 15px; font-weight: 700; color: #111; }
    .ot-sub { font-size: 12px; color: #9CA3AF; margin-top: 2px; }
    .ot-radio-dot {
        width: 20px; height: 20px;
        border-radius: 50%;
        border: 2px solid #D1D5DB;
        margin-left: auto;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        transition: all 0.2s;
    }
    .ot-label.checked .ot-radio-dot {
        border-color: #E63946;
        background: #E63946;
    }
    .ot-radio-dot::after {
        content: '';
        width: 8px; height: 8px;
        border-radius: 50%;
        background: #fff;
        display: none;
    }
    .ot-label.checked .ot-radio-dot::after { display: block; }

    /* ---- DELIVERY FIELDS ---- */
    .co-hidden { display: none; }

    .co-input-group { margin-bottom: 16px; }
    .co-input-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    .co-input, .co-textarea {
        width: 100%;
        border: 1.5px solid #E8E6E0;
        border-radius: 14px;
        padding: 14px 18px;
        font-size: 14px;
        font-family: 'DM Sans', sans-serif;
        color: #111;
        background: #FAFAF8;
        outline: none;
        transition: border-color 0.2s, background 0.2s;
    }
    .co-input:focus, .co-textarea:focus {
        border-color: #E63946;
        background: #fff;
    }
    .co-textarea { resize: none; height: 90px; }

    /* ---- PAYMENT ---- */
    .pm-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

    .pm-label {
        border: 2px solid #E8E6E0;
        border-radius: 18px;
        padding: 18px 20px;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .pm-label input[type=radio] { display: none; }
    .pm-label:hover { border-color: #10B981; background: #F0FDF4; }
    .pm-label.checked { border-color: #10B981; background: #F0FDF4; }
    .pm-label.checked .pm-radio-dot { border-color: #10B981; background: #10B981; }
    .pm-label.checked .pm-radio-dot::after { display: block; }

    .pm-icon {
        width: 46px; height: 46px;
        border-radius: 14px;
        background: #F4F3EF;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .pm-label.checked .pm-icon { background: #D1FAE5; }

    .pm-title { font-size: 15px; font-weight: 700; color: #111; }
    .pm-sub { font-size: 12px; color: #9CA3AF; margin-top: 2px; }

    .pm-radio-dot {
        width: 20px; height: 20px;
        border-radius: 50%;
        border: 2px solid #D1D5DB;
        margin-left: auto;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        transition: all 0.2s;
    }
    .pm-radio-dot::after {
        content: '';
        width: 8px; height: 8px;
        border-radius: 50%;
        background: #fff;
        display: none;
    }

    /* ---- RIGHT PANEL (ORDER SUMMARY) ---- */
    .co-right { position: sticky; top: 24px; }

    .co-summary {
        background: #fff;
        border-radius: 24px;
        padding: 28px;
        border: 1px solid #E8E6E0;
    }

    .summary-title {
        /* font-family: 'Syne', sans-serif; */
        font-size: 20px;
        font-weight: 700;
        color: #111;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid #F0EEE9;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
        font-size: 14px;
    }
    .summary-row .label { color: #6B7280; font-weight: 500; }
    .summary-row .value { font-weight: 700; color: #111; }
    .summary-row .value.discount { color: #16A34A; }

    .summary-divider {
        border: none;
        border-top: 1px dashed #E8E6E0;
        margin: 16px 0;
    }

    .summary-total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px;
        background: #F4F3EF;
        border-radius: 14px;
        margin-bottom: 20px;
    }
    .summary-total-label { font-size: 15px; font-weight: 700; color: #111; }
    .summary-total-value {
        /* font-family: 'Syne', sans-serif; */
        font-size: 28px;
        font-weight: 700;
        color: #E63946;
    }

    .co-place-btn {
        width: 100%;
        background: #E63946;
        color: #fff;
        border: none;
        border-radius: 16px;
        padding: 18px;
        /* font-family: 'Syne', sans-serif; */
        font-size: 17px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
    }
    .co-place-btn:hover { background: #c42d0b; transform: translateY(-1px); }
    .co-place-btn:active { transform: translateY(0); }

    .secure-note {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 14px;
        font-size: 12px;
        color: #9CA3AF;
        font-weight: 500;
    }

    /* ---- PAGE HEADER ---- */
    .co-header {
        max-width: 1200px;
        margin: 0 auto 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .co-header-left h1 {
        /* font-family: 'Syne', sans-serif; */
        font-size: 34px;
        font-weight: 700;
        color: #111;
    }
    .co-header-left p { color: #9CA3AF; font-size: 14px; margin-top: 4px; }

    .co-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #9CA3AF;
    }
    .co-breadcrumb a { color: #E63946; text-decoration: none; font-weight: 600; }
    .co-breadcrumb span { color: #D1D5DB; }

    /* ---- ERRORS ---- */
    .co-errors {
        background: #FEF2F2;
        border: 1.5px solid #FECACA;
        color: #DC2626;
        padding: 16px 20px;
        border-radius: 16px;
        margin-bottom: 20px;
        font-size: 14px;
    }
    .co-errors ul { margin-left: 18px; }
    .co-errors li { margin-bottom: 4px; }

    /* ---- EMPTY STATE ---- */
    .co-empty {
        text-align: center;
        padding: 60px 20px;
    }
    .co-empty h3 {
        /* font-family: 'Syne', sans-serif; */
        font-size: 22px;
        font-weight: 700;
        color: #111;
        margin-bottom: 8px;
    }
    .co-empty p { color: #9CA3AF; font-size: 14px; }

    /* ---- RESPONSIVE ---- */
    @media(max-width: 900px) {
        .co-wrap { grid-template-columns: 1fr; }
        .co-right { position: static; }
    }
    @media(max-width: 560px) {
        .order-type-grid, .pm-grid { grid-template-columns: 1fr; }
        .co-card { padding: 20px; }
        .co-item-right { min-width: 80px; }
        .co-page { padding: 20px 12px 60px; }
    }
</style>

<div class="co-page">

   

    <form method="POST" action="/place-order" id="checkoutForm">
        @csrf

        <div class="co-wrap">

            <!-- ============ LEFT SIDE ============ -->
            <div class="co-left">

                <!-- ERRORS -->
                @if ($errors->any())
                <div class="co-errors">
                    <strong style="font-weight:700;">Please fix the following:</strong>
                    <ul style="margin-top:8px;">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- STEP 1: ORDER ITEMS -->
                <div class="co-card">
                    <div class="co-card-title">
                        <span class="step-num">1</span>
                        Order Items
                        <span style="margin-left:auto; font-size:13px; font-weight:500; color:#9CA3AF; font-family:'DM Sans',sans-serif;">
                            {{ count($cart) }} {{ Str::plural('item', count($cart)) }}
                        </span>
                    </div>

                    @forelse($cart as $item)
                    @php
                        $offer    = $item['offer'];
                        $subtotal = $item['subtotal'] ?? ($item['price'] * $item['quantity']);
                    @endphp

                    <div class="co-item">
                        <!-- IMAGE -->
                        <img src="{{ asset('storage/'.$item['image']) }}" class="co-item-img" alt="{{ $item['name'] }}">

                        <!-- BODY -->
                        <div class="co-item-body">
                            <div class="co-item-name">{{ $item['name'] }}</div>

                            <!-- BADGES -->
                            @if($offer)
                            <div class="co-item-badges">
                                @if($offer->type === 'discount')
                                    <span class="badge-discount">🏷️ DISCOUNT</span>
                                @else
                                    <span class="badge-offer">🎁 OFFER</span>
                                @endif
                                <span class="badge-save">
                                    @if($offer->value_type === 'percent')
                                        {{ $offer->value }}% OFF
                                    @else
                                        £{{ $offer->value }} OFF
                                    @endif
                                </span>
                            </div>
                            @endif

                            <!-- PRICE -->
                            <div class="co-item-price-row">
                                @if($offer)
                                    <!-- <span class="price-new">£{{ number_format($item['final_price'], 2) }}</span> -->
                                @else
                                    <span class="price-normal">£{{ number_format($item['price'], 2) }}</span>
                                @endif
                            </div>

                            <!-- QTY CONTROLS -->
                            <div class="qty-controls">
                                <a href="/cart/decrease/{{ $item['id'] }}" class="qty-btn minus">−</a>
                                <span class="qty-num">{{ $item['quantity'] }}</span>
                                <a href="/cart/increase/{{ $item['id'] }}" class="qty-btn plus">+</a>
                            </div>
                        </div>

                        <!-- RIGHT: SUBTOTAL + REMOVE -->
                        <div class="co-item-right">
                            <div>
                                <div class="co-item-subtotal-label">Subtotal</div>
                                <div class="co-item-subtotal">£{{ number_format($subtotal, 2) }}</div>
                            </div>
                            <a href="/cart/remove/{{ $item['id'] }}" class="co-remove-btn">Remove ✕</a>
                        </div>
                    </div>

                    @empty
                    <div class="co-empty">
                        <div style="font-size:48px; margin-bottom:16px;">🛒</div>
                        <h3>Cart is Empty</h3>
                        <p>Add some items to proceed with checkout.</p>
                    </div>
                    @endforelse
                </div>

                <!-- STEP 2: ORDER TYPE -->
                <div class="co-card">
                    <div class="co-card-title">
                        <span class="step-num">2</span>
                        How would you like your order?
                    </div>

                    <div class="order-type-grid">
                        @if($restaurant->dine_in)
                        <label class="ot-label" id="ot-dinein">
                            <input type="radio" name="order_type" value="dine_in" required>
                            <div class="ot-icon">🍽️</div>
                            <div>
                                <div class="ot-title">Dine In</div>
                                <div class="ot-sub">Eat inside restaurant</div>
                            </div>
                            <div class="ot-radio-dot"></div>
                        </label>
                        @endif

                        @if($restaurant->home_delivery)
                        <label class="ot-label" id="ot-delivery">
                            <input type="radio" name="order_type" value="delivery" required>
                            <div class="ot-icon">🚚</div>
                            <div>
                                <div class="ot-title">Home Delivery</div>
                                <div class="ot-sub">Delivered to your door</div>
                            </div>
                            <div class="ot-radio-dot"></div>
                        </label>
                        @endif
                    </div>

                    <!-- DELIVERY ADDRESS (shown when delivery selected) -->
                    <div id="deliveryFields" class="co-hidden" style="margin-top:24px; padding-top:24px; border-top:1px solid #F0EEE9;">
                        <p style="font-size:13px; font-weight:700; color:#374151; margin-bottom:16px; text-transform:uppercase; letter-spacing:.05em;">
                            Delivery Details
                        </p>
                        <div class="co-input-group">
                            <label>Full Delivery Address</label>
                            <textarea id="address" name="address" class="co-textarea"
                                placeholder="House no., Street, Area, City..."></textarea>
                        </div>
                        <div class="co-input-group" style="margin-bottom:0;">
                            <label>Pin Code</label>
                            <input type="text" id="pincode" name="pincode" class="co-input"
                                placeholder="e.g. SW1A 1AA">
                        </div>
                    </div>
                </div>

                <!-- STEP 3: PAYMENT -->
                <div class="co-card">
                    <div class="co-card-title">
                        <span class="step-num">3</span>
                        Payment Method
                    </div>

                    <div class="pm-grid">
                        <label class="pm-label" id="pm-online">
                            <input type="radio" name="payment_method" value="online" required>
                            <div class="pm-icon">💳</div>
                            <div>
                                <div class="pm-title">Online Payment</div>
                                <div class="pm-sub">UPI / Card / Wallet</div>
                            </div>
                            <div class="pm-radio-dot"></div>
                        </label>

                        <label class="pm-label" id="pm-cod">
                            <input type="radio" name="payment_method" value="Cash On Delivery" required>
                            <div class="pm-icon">💵</div>
                            <div>
                                <div class="pm-title">Cash on Delivery</div>
                                <div class="pm-sub">Pay after delivery</div>
                            </div>
                            <div class="pm-radio-dot"></div>
                        </label>
                    </div>

                    <!-- PHONE (COD only) -->
                    <div id="phoneField" class="co-hidden" style="margin-top:20px; padding-top:20px; border-top:1px solid #F0EEE9;">
                        <div class="co-input-group" style="margin-bottom:0;">
                            <label>Phone Number</label>
                            <input type="text" id="phone" name="phone" class="co-input"
                                placeholder="e.g. +44 7700 900000">
                        </div>
                    </div>
                </div>

            </div>

            <!-- ============ RIGHT SIDE: ORDER SUMMARY ============ -->
            <div class="co-right">
                <div class="co-summary">

                    <div class="summary-title">Order Summary</div>

                    <!-- ITEM LIST (compact) -->
                    @foreach($cart as $item)
                    @php
                        $subtotal = $item['subtotal'] ?? ($item['price'] * $item['quantity']);
                    @endphp
                    <div style="display:flex; justify-content:space-between; margin-bottom:12px; font-size:14px;">
                        <span style="color:#374151; flex:1; min-width:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding-right:12px;">
                            {{ $item['name'] }}
                            <span style="color:#9CA3AF; font-weight:400;"> × {{ $item['quantity'] }}</span>
                        </span>
                        <span style="font-weight:700; color:#111; flex-shrink:0;">
                            £{{ number_format($subtotal, 2) }}
                        </span>
                    </div>
                    @endforeach

                    <hr class="summary-divider">

                    <!-- TOTALS -->
                    <div class="summary-row">
                        <span class="label">Original Total</span>
                        <span class="value">£{{ number_format($originalTotal, 2) }}</span>
                    </div>

                    @if($discount > 0)
                    <div class="summary-row">
                        <span class="label" style="color:#16A34A; display:flex; align-items:center; gap:5px;">
                            🏷️ Discount Saved
                        </span>
                        <span class="value discount">− £{{ number_format($discount, 2) }}</span>
                    </div>
                    @endif

                    <div class="summary-row">
                        <span class="label">Delivery</span>
                        <span class="value" style="color:#10B981;">Free</span>
                    </div>

                    <hr class="summary-divider">

                    <!-- FINAL TOTAL -->
                    <div class="summary-total-row">
                        <span class="summary-total-label">Total to Pay</span>
                        <span class="summary-total-value">£{{ number_format($finalTotal, 2) }}</span>
                    </div>

                    @if($discount > 0)
                    <div style="background:#F0FDF4; border:1px solid #BBF7D0; border-radius:12px; padding:12px 16px; margin-bottom:20px; display:flex; align-items:center; gap:8px; font-size:13px; font-weight:600; color:#15803D;">
                        🎉 You're saving £{{ number_format($discount, 2) }} on this order!
                    </div>
                    @endif

                    <!-- PLACE ORDER BUTTON -->
                    <button type="submit" class="co-place-btn" form="checkoutForm">
                        Place Order
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>

                    <div class="secure-note">
                        🔒 Secure & encrypted checkout
                    </div>

                </div>
            </div>

        </div>
    </form>

</div>

<script>
    /* ---- ORDER TYPE toggle ---- */
    document.querySelectorAll('input[name="order_type"]').forEach(radio => {
        radio.addEventListener('change', function () {
            document.querySelectorAll('.ot-label').forEach(l => l.classList.remove('checked'));
            this.closest('.ot-label').classList.add('checked');

            const df = document.getElementById('deliveryFields');
            const addr = document.getElementById('address');
            const pin  = document.getElementById('pincode');

            if (this.value === 'delivery') {
                df.classList.remove('co-hidden');
                addr.required = true;
                pin.required  = true;
            } else {
                df.classList.add('co-hidden');
                addr.required = false;
                pin.required  = false;
            }
        });
    });

    /* ---- PAYMENT METHOD toggle ---- */
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function () {
            document.querySelectorAll('.pm-label').forEach(l => l.classList.remove('checked'));
            this.closest('.pm-label').classList.add('checked');

            const pf    = document.getElementById('phoneField');
            const phone = document.getElementById('phone');

            if (this.value === 'Cash On Delivery') {
                pf.classList.remove('co-hidden');
                phone.required = true;
            } else {
                pf.classList.add('co-hidden');
                phone.required = false;
            }
        });
    });

    /* ---- FORM SUBMIT: route based on payment ---- */
    document.getElementById('checkoutForm').addEventListener('submit', function (e) {
        const pm = document.querySelector('input[name="payment_method"]:checked');
        if (pm && pm.value === 'online') {
            e.preventDefault();
            this.action = "{{ route('payment.pay') }}";
            this.submit();
        } else {
            this.action = '/place-order';
        }
    });
</script>

@endsection