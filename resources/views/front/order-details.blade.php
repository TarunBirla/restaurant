@extends('front.layouts.app')

@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap');

        .order-page * {
            font-family: 'Sora', sans-serif;
        }

        .order-page {
            background: #f0f2f5;
            min-height: 100vh;
            padding: 2.5rem 1.25rem;
        }

        /* CARDS */
        .card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* HEADER CARD */
        .header-card {
            padding: 2rem 2.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-title {
            font-size: 1.9rem;
            font-weight: 800;
            color: #111;
            letter-spacing: -0.04em;
        }

        .order-subtitle {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            color: #888;
            margin-top: 0.3rem;
            letter-spacing: 0.05em;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: #111;
            color: #fff;
            padding: 0.65rem 1.4rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
        }

        .back-btn:hover {
            background: #333;
            transform: translateY(-1px);
        }

        /* TRACKING */
        .tracking-card {
            padding: 2rem 2.5rem;
            margin-bottom: 1.5rem;
        }

        .tracking-card h2 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #111;
            letter-spacing: -0.02em;
            margin-bottom: 2.2rem;
        }

        .tracking-bar-wrap {
            position: relative;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 0 0.5rem;
        }

        .track-line-bg {
            position: absolute;
            top: 18px;
            left: 0;
            right: 0;
            height: 3px;
            background: #e8e8e8;
            border-radius: 10px;
            z-index: 0;
        }

        .track-line-active {
            position: absolute;
            top: 18px;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, #16a34a, #22c55e);
            border-radius: 10px;
            z-index: 1;
            transition: width 0.8s ease;
        }

        .track-step {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.6rem;
        }

        .step-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
            border: 3px solid #e8e8e8;
            background: #fff;
            color: #bbb;
            transition: all 0.3s ease;
        }

        .step-circle.active {
            background: #16a34a;
            border-color: #16a34a;
            color: #fff;
            box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.15);
        }

        .step-circle.cancelled {
            background: #ef4444;
            border-color: #ef4444;
            color: #fff;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15);
        }

        .step-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: #aaa;
            white-space: nowrap;
            letter-spacing: 0.02em;
        }

        .step-label.active {
            color: #16a34a;
        }

        .step-label.cancelled {
            color: #ef4444;
        }

        /* STATUS BADGE */
        .status-badge-wrap {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1.6rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        .badge-pending {
            background: #fef9c3;
            color: #a16207;
        }

        .badge-accepted {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-completed {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-cancelled {
            background: #fee2e2;
            color: #b91c1c;
        }

        /* INFO GRID */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 640px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        .info-card {
            padding: 1.75rem 2rem;
        }

        .info-card h3 {
            font-size: 0.8rem;
            font-weight: 700;
            color: #aaa;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 1.2rem;
        }

        .info-row {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .info-item label {
            font-size: 0.7rem;
            font-weight: 600;
            color: #bbb;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            display: block;
            margin-bottom: 0.2rem;
        }

        .info-item span {
            font-size: 0.9rem;
            font-weight: 600;
            color: #222;
        }

        .payment-status-paid {
            color: #16a34a;
        }

        .payment-status-pending {
            color: #d97706;
        }

        /* ITEMS CARD */
        .items-card {
            overflow: hidden;
        }

        .items-header {
            padding: 1.5rem 2.5rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .items-header h2 {
            font-size: 1.1rem;
            font-weight: 800;
            color: #111;
            letter-spacing: -0.02em;
        }

        .items-body {
            padding: 0 2.5rem 2rem;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.4rem 0;
            border-bottom: 1px solid #f5f5f5;
            gap: 1rem;
        }

        .order-item:last-of-type {
            border-bottom: none;
        }

        .item-left {
            display: flex;
            align-items: center;
            gap: 1.1rem;
        }

        .item-img {
            width: 70px;
            height: 70px;
            border-radius: 14px;
            object-fit: cover;
            flex-shrink: 0;
            background: #f3f4f6;
        }

        .item-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: #111;
            margin-bottom: 0.3rem;
        }

        .item-meta {
            font-size: 0.8rem;
            color: #999;
            font-family: 'JetBrains Mono', monospace;
        }

        .item-total {
            font-size: 1rem;
            font-weight: 800;
            color: #e11d48;
            white-space: nowrap;
        }

        /* TOTALS */
        .totals-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2.5rem 2rem;
            border-top: 2px solid #f0f0f0;
            margin-top: 0.5rem;
        }

        .totals-label {
            font-size: 1rem;
            font-weight: 700;
            color: #111;
        }

        .totals-amount {
            font-size: 1.6rem;
            font-weight: 800;
            color: #e11d48;
            letter-spacing: -0.04em;
            font-family: 'JetBrains Mono', monospace;
        }
    </style>

    <div class="order-page">
        <div class="mx-auto" style="max-width: 1280px;">
            <div style="display: grid; grid-template-columns: 260px 1fr; gap: 2rem; align-items: start;">

                {{-- SIDEBAR --}}
                <div>
                    @include('front.layouts.user-sidebar')
                </div>

                {{-- MAIN CONTENT --}}
                <div>

                    {{-- HEADER --}}
                    <div class="card header-card">
                        <div>
                            <div class="order-title">Order Details</div>
                            <div class="order-subtitle">ORDER #{{ $order->id }}</div>
                        </div>
                        <a href="/my-orders" class="back-btn">
                            ← Back to Orders
                        </a>
                    </div>

                    {{-- TRACKING --}}

                    <div class="card tracking-card">

                        <h2>Live Delivery Tracking</h2>

                        @php

                            $deliveryStatus =
                                $order->delivery_status ?? 'searching';

                            /*
                            |--------------------------------------------------------------------------
                            | TRACK WIDTH
                            |--------------------------------------------------------------------------
                            */

                            $progress = '5%';

                            if ($deliveryStatus == 'searching') {
                                $progress = '10%';
                            } elseif ($deliveryStatus == 'almost_picking') {
                                $progress = '30%';
                            } elseif (
                                $deliveryStatus == 'waiting_at_pickup' ||
                                $deliveryStatus == 'picking'
                            ) {
                                $progress = '55%';
                            } elseif ($deliveryStatus == 'in_transit') {
                                $progress = '80%';
                            } elseif ($deliveryStatus == 'delivered') {
                                $progress = '100%';
                            } elseif ($deliveryStatus == 'canceled') {
                                $progress = '100%';
                            }

                        @endphp

                        <div class="tracking-bar-wrap">

                            <div class="track-line-bg"></div>

                            <div class="track-line-active" style="
                                                                width: {{ $progress }};

                                                                @if($deliveryStatus == 'canceled')
                                                                    background: linear-gradient(
                                                                        90deg,
                                                                        #ef4444,
                                                                        #f87171
                                                                    );
                                                                @endif
                                                            ">
                            </div>

                            {{-- STEP 1 --}}
                            <div class="track-step">

                                <div class="step-circle
                                                                {{
        in_array($deliveryStatus, [

            'searching',
            'almost_picking',
            'waiting_at_pickup',
            'picking',
            'in_transit',
            'delivered'

        ])
        ? 'active'
        : ''
                                                                }}
                                                            ">
                                    ✓
                                </div>

                                <div class="step-label
                                                                {{
        in_array($deliveryStatus, [

            'searching',
            'almost_picking',
            'waiting_at_pickup',
            'picking',
            'in_transit',
            'delivered'

        ])
        ? 'active'
        : ''
                                                                }}
                                                            ">
                                    Driver Search
                                </div>

                            </div>

                            {{-- STEP 2 --}}
                            <div class="track-step">

                                <div class="step-circle
                                                                {{
        in_array($deliveryStatus, [

            'almost_picking',
            'waiting_at_pickup',
            'picking',
            'in_transit',
            'delivered'

        ])
        ? 'active'
        : ''
                                                                }}
                                                            ">
                                    ✓
                                </div>

                                <div class="step-label
                                                                {{
        in_array($deliveryStatus, [

            'almost_picking',
            'waiting_at_pickup',
            'picking',
            'in_transit',
            'delivered'

        ])
        ? 'active'
        : ''
                                                                }}
                                                            ">
                                    Driver Assigned
                                </div>

                            </div>

                            {{-- STEP 3 --}}
                            <div class="track-step">

                                <div class="step-circle
                                                                {{
        in_array($deliveryStatus, [

            'waiting_at_pickup',
            'picking',
            'in_transit',
            'delivered'

        ])
        ? 'active'
        : ''
                                                                }}
                                                            ">
                                    ✓
                                </div>

                                <div class="step-label
                                                                {{
        in_array($deliveryStatus, [

            'waiting_at_pickup',
            'picking',
            'in_transit',
            'delivered'

        ])
        ? 'active'
        : ''
                                                                }}
                                                            ">
                                    Pickup
                                </div>

                            </div>

                            {{-- STEP 4 --}}
                            <div class="track-step">

                                <div class="step-circle
                                                                {{
        in_array($deliveryStatus, [

            'in_transit',
            'delivered'

        ])
        ? 'active'
        : ''
                                                                }}
                                                            ">
                                    ✓
                                </div>

                                <div class="step-label
                                                                {{
        in_array($deliveryStatus, [

            'in_transit',
            'delivered'

        ])
        ? 'active'
        : ''
                                                                }}
                                                            ">
                                    On The Way
                                </div>

                            </div>

                            {{-- STEP 5 --}}
                            <div class="track-step">

                                @if($deliveryStatus == 'canceled')

                                    <div class="step-circle cancelled">
                                        ✕
                                    </div>

                                    <div class="step-label cancelled">
                                        Cancelled
                                    </div>

                                @else

                                                        <div
                                                            class="step-circle
                                                                                                                                                                                                                    {{
                                    $deliveryStatus == 'delivered'
                                    ? 'active'
                                    : ''
                                                                                                                                                                                                                    }}
                                                                                                                                                                                                                ">
                                                            ✓
                                                        </div>

                                                        <div
                                                            class="step-label
                                                                                                                                                                                                                    {{
                                    $deliveryStatus == 'delivered'
                                    ? 'active'
                                    : ''
                                                                                                                                                                                                                    }}
                                                                                                                                                                                                                ">
                                                            Delivered
                                                        </div>

                                @endif

                            </div>

                        </div>

                        {{-- STATUS BADGE --}}
                        <div class="status-badge-wrap">

                            @if($deliveryStatus == 'searching')

                                <span class="status-badge badge-searching">
                                    🔎 Searching Driver
                                </span>

                            @elseif($deliveryStatus == 'almost_picking')

                                <span class="status-badge badge-almost_picking">
                                    🛵 Driver Coming to Restaurant
                                </span>

                            @elseif($deliveryStatus == 'waiting_at_pickup')

                                <span class="status-badge badge-almost_picking">
                                    🍔 Driver Waiting at Restaurant
                                </span>

                            @elseif($deliveryStatus == 'picking')

                                <span class="status-badge badge-almost_picking">
                                    📦 Order Pickup Started
                                </span>

                            @elseif($deliveryStatus == 'in_transit')

                                <span class="status-badge badge-in_transit">
                                    🚚 On The Way
                                </span>

                            @elseif($deliveryStatus == 'delivered')

                                <span class="status-badge badge-delivered">
                                    ✅ Delivered Successfully
                                </span>

                            @elseif($deliveryStatus == 'canceled')

                                <span class="status-badge badge-canceled">
                                    ❌ Delivery Cancelled
                                </span>

                            @endif

                        </div>

                    </div>



                    @if($order->tracking_url)

                        <button type="button" onclick="openTracking()"
                            class="bg-green-500 text-white px-6 py-3 rounded-2xl inline-block mt-5 mb-5">
                            Track Delivery
                        </button>

                        <div id="trackingContainer" style="display:none;" class="mt-4 mb-4">
                            <iframe id="trackingFrame" src="" width="100%" height="700"
                                style="border:none; border-radius:16px; background:#fff;">
                            </iframe>
                        </div>

                        <script>
                            function openTracking() {

                                document.getElementById('trackingContainer').style.display = 'block';

                                document.getElementById('trackingFrame').src =
                                    "{{ $order->tracking_url }}";

                                // optional scroll
                                document.getElementById('trackingContainer')
                                    .scrollIntoView({ behavior: 'smooth' });
                            }
                        </script>

                    @endif



                    {{-- DRIVER DETAILS --}}
                    @if($order->driver_name)

                        <div class="card info-card mt-4">

                            <h3>Driver Details</h3>

                            <div class="info-row">

                                <div class="info-item">
                                    <label>Driver Name</label>

                                    <span>
                                        {{ $order->driver_name }}
                                    </span>
                                </div>

                                <div class="info-item">
                                    <label>Driver Phone</label>

                                    <span>
                                        {{ $order->driver_phone ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="info-item">
                                    <label>Delivery Status</label>

                                    <span style="
                                                                                                color:#16a34a;
                                                                                                font-weight:700;
                                                                                                text-transform:capitalize;
                                                                                            ">
                                        {{ str_replace('_', ' ', $order->delivery_status) }}
                                    </span>
                                </div>

                                @if($order->picked_at)

                                    <div class="info-item">
                                        <label>Picked At</label>

                                        <span>
                                            {{ \Carbon\Carbon::parse($order->picked_at)->format('d M Y h:i A') }}
                                        </span>
                                    </div>

                                @endif

                                @if($order->delivered_at)

                                    <div class="info-item">
                                        <label>Delivered At</label>

                                        <span>
                                            {{ \Carbon\Carbon::parse($order->delivered_at)->format('d M Y h:i A') }}
                                        </span>
                                    </div>

                                @endif

                            </div>

                        </div>

                    @endif


                    {{-- PAYMENT + DELIVERY --}}
                    <div class="info-grid">

                        {{-- Payment --}}
                        <div class="card info-card">
                            <h3>Payment Details</h3>
                            <div class="info-row">
                                <div class="info-item">
                                    <label>Method</label>
                                    <span>{{ ucfirst($order->payment_method) }}</span>
                                </div>
                                <div class="info-item">
                                    <label>Status</label>
                                    @php $pStatus = $order->payment->payment_status ?? 'pending'; @endphp
                                    <span class="payment-status-{{ strtolower($pStatus) }}">
                                        {{ ucfirst($pStatus) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Delivery --}}
                        <div class="card info-card">
                            <h3>Delivery Details</h3>
                            <div class="info-row">
                                <div class="info-item">
                                    <label>Order Type</label>
                                    <span>{{ ucfirst(str_replace('_', ' ', $order->order_type)) }}</span>
                                </div>
                                <div class="info-item">
                                    <label>Phone</label>
                                    <span>{{ $order->phone ?? '—' }}</span>
                                </div>
                                <div class="info-item">
                                    <label>Address</label>
                                    <span>{{ $order->address ?? '—' }}</span>
                                </div>
                                <div class="info-item">
                                    <label>Delivery Status</label>
                                    <span>{{ $order->delivery_status ?? '—' }}</span>
                                </div>
                            </div>
                        </div>

                    </div>


                    @if($order->delivery_status == 'delivered')

                        @if(!$order->review)

                            {{-- REVIEW BUTTON --}}

                            <div class="card info-card mb-4" style="
                                                                                            display:flex;
                                                                                            justify-content:space-between;
                                                                                            align-items:center;
                                                                                            flex-wrap:wrap;
                                                                                            gap:20px;
                                                                                        ">

                                <div>

                                    <h3 style="
                                                                                                margin:0 0 6px;
                                                                                                font-size:22px;
                                                                                                font-weight:800;
                                                                                                color:#111827;
                                                                                            ">
                                        Enjoyed Your Meal?
                                    </h3>

                                    <p style="
                                                                                                margin:0;
                                                                                                color:#6B7280;
                                                                                                font-size:14px;
                                                                                            ">
                                        Share your experience with this restaurant.
                                    </p>

                                </div>

                                <button onclick="openReviewModal()" style="
                                                                                                background:linear-gradient(135deg,#111827,#374151);
                                                                                                color:#fff;
                                                                                                border:none;
                                                                                                padding:14px 26px;
                                                                                                border-radius:14px;
                                                                                                font-weight:700;
                                                                                                cursor:pointer;
                                                                                                font-size:15px;
                                                                                                transition:0.3s;
                                                                                                box-shadow:0 10px 25px rgba(0,0,0,0.15);
                                                                                            "
                                    onmouseover="this.style.transform='translateY(-2px)'"
                                    onmouseout="this.style.transform='translateY(0)'">

                                    ⭐ Write Review

                                </button>

                            </div>

                            {{-- REVIEW MODAL --}}

                            <div id="reviewModal" style="
                                                                                            position:fixed;
                                                                                            inset:0;
                                                                                            background:rgba(0,0,0,0.6);
                                                                                            z-index:99999;
                                                                                            display:none;
                                                                                            align-items:center;
                                                                                            justify-content:center;
                                                                                            padding:20px;
                                                                                        ">

                                <div style="
                                                                                                background:#fff;
                                                                                                width:100%;
                                                                                                max-width:550px;
                                                                                                border-radius:28px;
                                                                                                overflow:hidden;
                                                                                                animation:reviewPop .25s ease;
                                                                                            ">

                                    {{-- HEADER --}}

                                    <div style="
                                                                                                padding:24px 30px;
                                                                                                border-bottom:1px solid #F3F4F6;
                                                                                                display:flex;
                                                                                                justify-content:space-between;
                                                                                                align-items:center;
                                                                                            ">

                                        <div>

                                            <h2 style="
                                                                                                        margin:0 0 5px;
                                                                                                        font-size:26px;
                                                                                                        font-weight:800;
                                                                                                        color:#111827;
                                                                                                    ">
                                                Rate Your Order
                                            </h2>

                                            <p style="
                                                                                                        margin:0;
                                                                                                        color:#6B7280;
                                                                                                        font-size:14px;
                                                                                                    ">
                                                Your feedback helps improve service.
                                            </p>

                                        </div>

                                        <button onclick="closeReviewModal()" style="
                                                                                                        background:#F3F4F6;
                                                                                                        border:none;
                                                                                                        width:42px;
                                                                                                        height:42px;
                                                                                                        border-radius:50%;
                                                                                                        cursor:pointer;
                                                                                                        font-size:18px;
                                                                                                        font-weight:700;
                                                                                                    ">

                                            ✕

                                        </button>

                                    </div>

                                    {{-- BODY --}}

                                    <form method="POST" action="/submit-review/{{ $order->id }}">

                                        @csrf

                                        <div style="padding:30px;">

                                            {{-- STAR RATING --}}

                                            <div style="margin-bottom:30px;">

                                                <label style="
                                            display:block;
                                            margin-bottom:20px;
                                            font-size:15px;
                                            font-weight:700;
                                            color:#111827;
                                            text-align:center;
                                        ">
                                                    Select Rating
                                                </label>

                                                <div class="star-rating">

                                                    @for($i = 5; $i >= 1; $i--)

                                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>

                                                        <label for="star{{ $i }}" class="star">

                                                            ★

                                                        </label>

                                                    @endfor

                                                </div>

                                                <p id="ratingText" style="
                                            text-align:center;
                                            margin-top:14px;
                                            font-size:14px;
                                            font-weight:700;
                                            color:#6B7280;
                                        ">

                                                    Tap a star to rate

                                                </p>

                                            </div>

                                            {{-- REVIEW TEXTAREA --}}

                                            <div style="margin-bottom:25px;">

                                                <label style="
                                                                                                            display:block;
                                                                                                            margin-bottom:12px;
                                                                                                            font-size:15px;
                                                                                                            font-weight:700;
                                                                                                            color:#111827;
                                                                                                        ">
                                                    Write Review
                                                </label>

                                                <textarea name="review" rows="5"
                                                    placeholder="Tell us about food quality, delivery, packaging..." style="
                                                                                                                width:100%;
                                                                                                                border:1px solid #E5E7EB;
                                                                                                                border-radius:18px;
                                                                                                                padding:18px;
                                                                                                                resize:none;
                                                                                                                outline:none;
                                                                                                                font-size:14px;
                                                                                                                line-height:1.7;
                                                                                                            "></textarea>

                                            </div>

                                            {{-- BUTTONS --}}

                                            <div style="
                                                                                                        display:flex;
                                                                                                        justify-content:flex-end;
                                                                                                        gap:12px;
                                                                                                    ">

                                                <button type="button" onclick="closeReviewModal()" style="
                                                                                                                background:#F3F4F6;
                                                                                                                color:#111827;
                                                                                                                border:none;
                                                                                                                padding:14px 22px;
                                                                                                                border-radius:14px;
                                                                                                                font-weight:700;
                                                                                                                cursor:pointer;
                                                                                                            ">

                                                    Cancel

                                                </button>

                                                <button type="submit" style="
                                                                                                                background:linear-gradient(135deg,#16A34A,#22C55E);
                                                                                                                color:#fff;
                                                                                                                border:none;
                                                                                                                padding:14px 28px;
                                                                                                                border-radius:14px;
                                                                                                                font-weight:700;
                                                                                                                cursor:pointer;
                                                                                                                box-shadow:0 10px 25px rgba(34,197,94,0.25);
                                                                                                            ">

                                                    Submit Review

                                                </button>

                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        @else

                            {{-- SHOW REVIEW --}}

                            <div class="card info-card mb-4">

                                <div style="
                                                                                display:flex;
                                                                                justify-content:space-between;
                                                                                align-items:flex-start;
                                                                                gap:20px;
                                                                                flex-wrap:wrap;
                                                                            ">

                                    <div>

                                        <h3 style="
                                                                                        margin:0 0 10px;
                                                                                        font-size:24px;
                                                                                        font-weight:800;
                                                                                        color:#111827;
                                                                                    ">
                                            Your Review
                                        </h3>

                                        <div style="
                                                                                        font-size:28px;
                                                                                        margin-bottom:14px;
                                                                                    ">

                                            @for($i = 1; $i <= $order->review->rating; $i++)

                                                ⭐

                                            @endfor

                                        </div>

                                        <p style="
                                                                                        color:#4B5563;
                                                                                        line-height:1.8;
                                                                                        font-size:15px;
                                                                                        margin:0;
                                                                                    ">

                                            {{ $order->review->review }}

                                        </p>

                                    </div>

                                    <div style="
                                                                                    background:#ECFDF5;
                                                                                    color:#16A34A;
                                                                                    padding:10px 18px;
                                                                                    border-radius:30px;
                                                                                    font-size:13px;
                                                                                    font-weight:700;
                                                                                ">
                                        ✓ Submitted
                                    </div>

                                </div>

                            </div>

                        @endif

                    @endif


                    <style>
                        @keyframes reviewPop {

                            from {

                                opacity: 0;
                                transform: scale(.9);

                            }

                            to {

                                opacity: 1;
                                transform: scale(1);

                            }
                        }
                    </style>

                    <script>

                        function openReviewModal() {

                            document.getElementById('reviewModal').style.display = 'flex';
                        }

                        function closeReviewModal() {

                            document.getElementById('reviewModal').style.display = 'none';
                        }

                    </script>
                    {{-- ORDERED ITEMS --}}
                    <div class="card items-card">
                        <div class="items-header">
                            <h2>Ordered Items</h2>
                        </div>

                        <div class="items-body">
                            @php $grandTotal = 0; @endphp

                            @foreach($order->items as $item)
                                @php
                                    $subtotal = $item->price * $item->quantity;
                                    $grandTotal += $subtotal;
                                @endphp

                                <div class="order-item">
                                    <div class="item-left">
                                        <img src="{{ $item->product && $item->product->image ? asset('storage/' . $item->product->image) : asset('no-image.png') }}"
                                            class="item-img" alt="{{ $item->product->name ?? 'Product' }}">
                                        <div>
                                            <div class="item-name">{{ $item->product->name }}</div>
                                            <div class="item-meta">£{{ number_format($item->price, 2) }} × {{ $item->quantity }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-total">£{{ number_format($subtotal, 2) }}</div>
                                </div>
                            @endforeach
                        </div>

                        <div class="totals-row">
                            <span class="totals-label">Total Amount</span>
                            <span class="totals-amount">£{{ number_format($grandTotal, 2) }}</span>
                        </div>
                    </div>

                </div>{{-- end main --}}
            </div>
        </div>
    </div>


    <style>
        .star-rating {

            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            gap: 8px;
        }

        .star-rating input {

            display: none;
        }

        .star-rating .star {

            font-size: 52px;
            color: #D1D5DB;
            cursor: pointer;
            transition: 0.25s ease;
        }

        /*
    |--------------------------------------------------------------------------
    | HOVER EFFECT
    |--------------------------------------------------------------------------
    */

        .star-rating .star:hover,

        .star-rating .star:hover~.star {

            color: #FBBF24;
            transform: scale(1.12);
        }

        /*
    |--------------------------------------------------------------------------
    | ACTIVE SELECTED
    |--------------------------------------------------------------------------
    */

        .star-rating input:checked~.star {

            color: #F59E0B;
        }

        /*
    |--------------------------------------------------------------------------
    | SMALL ANIMATION
    |--------------------------------------------------------------------------
    */

        .star-rating .star:active {

            transform: scale(.9);
        }
    </style>
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const stars = document.querySelectorAll(

                '.star-rating input'
            );

            const text =
                document.getElementById('ratingText');

            stars.forEach(star => {

                star.addEventListener('change', function () {

                    let value = this.value;

                    if (value == 1) {

                        text.innerHTML =
                            "😞 Poor";
                    }

                    else if (value == 2) {

                        text.innerHTML =
                            "🙂 Average";
                    }

                    else if (value == 3) {

                        text.innerHTML =
                            "😊 Good";
                    }

                    else if (value == 4) {

                        text.innerHTML =
                            "😍 Very Good";
                    }

                    else if (value == 5) {

                        text.innerHTML =
                            "🔥 Excellent";
                    }

                });

            });

        });

    </script>




@endsection