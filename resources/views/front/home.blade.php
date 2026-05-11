@extends('front.layouts.app')
@section('content')

    <!-- HERO SECTION -->
    <section style="position:relative; background:#0D0D0D; color:#fff; overflow:hidden;">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070"
            style="width:100%; height:520px; object-fit:cover; opacity:0.35; display:block;">
        <div
            style="position:absolute; inset:0; background:linear-gradient(90deg, rgba(13,13,13,0.85) 0%, rgba(13,13,13,0.3) 100%); display:flex; align-items:center;">
            <div style="max-width:1280px; margin:0 auto; padding:0 24px; width:100%;">
                <div style="max-width:620px;">
                    <div
                        style="display:inline-flex; align-items:center; gap:8px; background:rgba(232,55,14,0.2); border:1px solid rgba(232,55,14,0.4); padding:7px 16px; border-radius:999px; margin-bottom:24px;">
                        <i data-lucide="zap" style="width:14px; height:14px; color:#E8370E;"></i>
                        <span style="font-size:13px; font-weight:600; color:#E8370E; font-family:'Syne',sans-serif;">Fast
                            Delivery In 30 Min</span>
                    </div>
                    <h1
                        style="font-family:'Syne',sans-serif; font-size:30px; font-weight:800; line-height:1.1; margin:0 0 20px;">
                        Delicious Food<br><span style="color:#E8370E;">Delivered</span> To<br>Your Door
                    </h1>
                    <p style="font-size:18px; color:#D1D5DB; line-height:1.7; margin:0 0 36px; max-width:480px;">
                        Explore premium restaurants, tasty meals, and amazing offers near you.
                    </p>
                    <div style="display:flex; gap:14px; flex-wrap:wrap;">
                        <a href="#products" class="btn-primary"
                            style="padding:16px 32px; font-size:16px; display:flex; align-items:center; gap:9px; text-decoration:none;">
                            <i data-lucide="shopping-bag" style="width:18px; height:18px;"></i> Order Now
                        </a>
                        <a href="#categories"
                            style="padding:16px 32px; font-size:16px; font-family:'Syne',sans-serif; font-weight:700; border:2px solid rgba(255,255,255,0.3); border-radius:12px; color:#fff; text-decoration:none; display:flex; align-items:center; gap:9px; transition:border-color .18s;"
                            onmouseover="this.style.borderColor='rgba(255,255,255,0.7)'"
                            onmouseout="this.style.borderColor='rgba(255,255,255,0.3)'">
                            <i data-lucide="grid-2x2" style="width:18px; height:18px;"></i> Explore Menu
                        </a>
                    </div>
                    <!-- STATS ROW -->
                    <div style="display:flex; gap:36px; margin-top:48px;">
                        <div>
                            <p
                                style="font-family:'Syne',sans-serif; font-size:28px; font-weight:800; margin:0; color:#fff;">
                                500+</p>
                            <p style="font-size:13px; color:#9CA3AF; margin:3px 0 0;">Menu Items</p>
                        </div>
                        <div style="width:1px; background:rgba(255,255,255,0.15);"></div>
                        <div>
                            <p
                                style="font-family:'Syne',sans-serif; font-size:28px; font-weight:800; margin:0; color:#fff;">
                                4.9★</p>
                            <p style="font-size:13px; color:#9CA3AF; margin:3px 0 0;">Avg Rating</p>
                        </div>
                        <div style="width:1px; background:rgba(255,255,255,0.15);"></div>
                        <div>
                            <p
                                style="font-family:'Syne',sans-serif; font-size:28px; font-weight:800; margin:0; color:#fff;">
                                10K+</p>
                            <p style="font-size:13px; color:#9CA3AF; margin:3px 0 0;">Happy Customers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="
    padding:80px 0;
    background:linear-gradient(135deg,#FFF7F4,#FFFFFF);
">

    <div style="
        max-width:1280px;
        margin:auto;
        padding:0 24px;
    ">

        <div style="
            display:grid;
            grid-template-columns:1.2fr .8fr;
            gap:50px;
            align-items:center;
        "
        class="qr-wrapper">

            <!-- LEFT CONTENT -->

            <div>

                <span style="
                    background:#FFE7E0;
                    color:#E8370E;
                    padding:8px 18px;
                    border-radius:50px;
                    font-size:13px;
                    font-weight:700;
                    display:inline-block;
                    margin-bottom:20px;
                    font-family:'Syne',sans-serif;
                ">
                    Scan & Order
                </span>

                <h1 style="
                    font-size:34px;
                    line-height:1.1;
                    font-weight:800;
                    margin-bottom:20px;
                    font-family:'Syne',sans-serif;
                    color:#111827;
                "
                class="qr-title">

                    Scan QR Code <br>
                    For Restaurant Menu

                </h1>

                <p style="
                    color:#6B7280;
                    font-size:18px;
                    line-height:1.8;
                    margin-bottom:35px;
                    max-width:600px;
                ">

                    Explore delicious meals, discover restaurants,
                    and order food instantly by scanning the QR code.

                </p>

                <div style="
                    display:flex;
                    gap:18px;
                    flex-wrap:wrap;
                ">

                    <div style="
                        display:flex;
                        align-items:center;
                        gap:10px;
                    ">

                        <div style="
                            width:44px;
                            height:44px;
                            background:#E8370E;
                            border-radius:12px;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                        ">

                            <i data-lucide="utensils"
                            style="width:20px;height:20px;color:#fff;"></i>

                        </div>

                        <div>

                            <h4 style="
                                margin:0;
                                font-size:16px;
                                font-weight:700;
                            ">
                                Premium Restaurants
                            </h4>

                            <p style="
                                margin:0;
                                color:#6B7280;
                                font-size:14px;
                            ">
                                Top quality food
                            </p>

                        </div>

                    </div>

                    <div style="
                        display:flex;
                        align-items:center;
                        gap:10px;
                    ">

                        <div style="
                            width:44px;
                            height:44px;
                            background:#111827;
                            border-radius:12px;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                        ">

                            <i data-lucide="clock-3"
                            style="width:20px;height:20px;color:#fff;"></i>

                        </div>

                        <div>

                            <h4 style="
                                margin:0;
                                font-size:16px;
                                font-weight:700;
                            ">
                                Fast Ordering
                            </h4>

                            <p style="
                                margin:0;
                                color:#6B7280;
                                font-size:14px;
                            ">
                                Instant menu access
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT QR -->

            <div style="
                display:flex;
                justify-content:center;
            ">

                <div style="
                    background:#fff;
                    padding:35px;
                    border-radius:30px;
                    box-shadow:0 20px 60px rgba(0,0,0,.08);
                    text-align:center;
                    border:1px solid #F1F1F1;
                    max-width:360px;
                    width:100%;
                ">

                    <div style="
                        width:90px;
                        height:90px;
                        background:#FFF2EE;
                        border-radius:24px;
                        margin:auto auto 25px;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                    ">

                        <i data-lucide="qr-code"
                        style="
                            width:42px;
                            height:42px;
                            color:#E8370E;
                        "></i>

                    </div>

                    <h3 style="
                        font-size:28px;
                        font-weight:800;
                        margin-bottom:10px;
                        font-family:'Syne',sans-serif;
                    ">
                        Scan Me
                    </h3>

                    <p style="
                        color:#6B7280;
                        font-size:15px;
                        margin-bottom:25px;
                    ">
                        Open restaurant menu instantly
                    </p>

                    <div style="
                        background:#fff;
                        padding:20px;
                        border-radius:20px;
                        display:inline-block;
                        border:1px solid #F1F1F1;
                    ">

                        {!! QrCode::size(220)->generate(url('/restaurants')) !!}

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<style>

@media(max-width:992px){

    .qr-wrapper{
        grid-template-columns:1fr !important;
        text-align:center;
    }

    .qr-title{
        font-size:42px !important;
    }

}

@media(max-width:576px){

    .qr-title{
        font-size:32px !important;
    }

}

</style>
    <!-- CATEGORY SECTION -->
    <section id="categories" style="max-width:1280px; margin:0 auto; padding:80px 24px;">
         
        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:40px;">
            <div>
                <p
                    style="color:#E8370E; font-family:'Syne',sans-serif; font-weight:700; font-size:14px; letter-spacing:.08em; text-transform:uppercase; margin:0 0 8px;">
                    Browse</p>
                <h2 style="font-family:'Syne',sans-serif; font-size:40px; font-weight:800; margin:0;">Food Categories</h2>
            </div>
            <p style="color:#6B7280; font-size:15px;">Choose your favorite category</p>
        </div>
        <div style="display:grid; grid-template-columns:repeat(5,1fr); gap:18px;">
            @foreach($categories as $category)
                <a href="/category/{{ $category->id }}"
                    style="background:#fff; border-radius:18px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,.06); text-decoration:none; transition:all .22s; display:block;"
                    onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 32px rgba(0,0,0,.12)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 12px rgba(0,0,0,.06)'">
                    <!-- <div style="overflow:hidden;">
                        <img src="{{ asset('storage/' . $category->image) }}"
                            style="width:100%; height:180px; object-fit:cover; transition:transform .5s;"
                            onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                    </div> -->
                    <div style="padding:16px; text-align:center;">
                        <h3 style="font-family:'Syne',sans-serif; font-weight:800; font-size:17px; margin:0; color:#0D0D0D;">
                            {{ $category->name }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- FEATURED PRODUCTS -->
    <section id="products" style="background:#fff; padding:80px 0;">
        <div style="max-width:1280px; margin:0 auto; padding:0 24px;">
            <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:40px;">
                <div>
                    <p
                        style="color:#E8370E; font-family:'Syne',sans-serif; font-weight:700; font-size:14px; letter-spacing:.08em; text-transform:uppercase; margin:0 0 8px;">
                        Today's Pick</p>
                    <h2 style="font-family:'Syne',sans-serif; font-size:40px; font-weight:800; margin:0;">Featured Products
                    </h2>
                </div>
                <p style="color:#6B7280; font-size:15px;">Most popular dishes today</p>
            </div>
            <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:24px;">
                @foreach($products as $product)
                    <div style="background:#fff; border-radius:20px; overflow:hidden; box-shadow:0 2px 16px rgba(0,0,0,.07); border:1px solid #F0F0EC; transition:all .22s;"
                        onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 16px 40px rgba(0,0,0,.12)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 16px rgba(0,0,0,.07)'">
                        <div style="position:relative; overflow:hidden;">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                style="width:100%; height:220px; object-fit:cover; transition:transform .5s;"
                                onmouseover="this.style.transform='scale(1.07)'" onmouseout="this.style.transform='scale(1)'">
                            <div style="position:absolute; top:12px; left:12px;" class="badge-primary">
                                <span style="display:flex; align-items:center; gap:4px;"><i data-lucide="star"
                                        style="width:11px; height:11px; fill:#fff;"></i> Featured</span>
                            </div>
                        </div>
                        <div style="padding:20px;">
                            <div
                                style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:10px;">
                                <h3
                                    style="font-family:'Syne',sans-serif; font-weight:800; font-size:18px; margin:0; line-height:1.3;">
                                    {{ $product->name }}</h3>
                                <span
                                    style="font-family:'Syne',sans-serif; font-size:20px; font-weight:800; color:#E8370E; white-space:nowrap; margin-left:8px;">€{{ $product->price }}</span>
                            </div>
                            <p style="color:#6B7280; font-size:14px; line-height:1.6; margin:0 0 18px;">
                                {{ Str::limit($product->description, 80) }}</p>
                            <div style="display:flex; gap:10px;">
                                <a href="/product/{{ $product->id }}" class="btn-black"
                                    style="flex:1; text-align:center; padding:11px 0; font-size:14px; text-decoration:none;">View</a>
                                <form method="POST" action="/cart/add" style="flex:1;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="current_url" value="{{ url()->current() }}">

                                    <button class="btn-primary"
                                        style="width:100%; padding:11px 0; font-size:14px; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:6px;">
                                        <i data-lucide="shopping-cart" style="width:14px; height:14px;"></i> Add
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- OFFER SECTION -->
    <section style="background:#0D0D0D; padding:80px 0; color:#fff;">
        <div style="max-width:1280px; margin:0 auto; padding:0 24px;">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:60px; align-items:center;">
                <div>
                    <div
                        style="display:inline-flex; align-items:center; gap:8px; background:rgba(232,55,14,0.15); border:1px solid rgba(232,55,14,0.3); padding:7px 16px; border-radius:999px; margin-bottom:24px;">
                        <i data-lucide="tag" style="width:14px; height:14px; color:#E8370E;"></i>
                        <span style="font-size:13px; font-weight:700; color:#E8370E; font-family:'Syne',sans-serif;">Limited
                            Time Offer</span>
                    </div>
                    <h2
                        style="font-family:'Syne',sans-serif; font-size:52px; font-weight:800; line-height:1.15; margin:0 0 20px;">
                        Get <span style="color:#E8370E;">30% Off</span><br>On Your First Order</h2>
                    <p style="color:#D1D5DB; font-size:17px; line-height:1.7; margin:0 0 36px;">Enjoy premium dishes from
                        top restaurants. Fresh food, fast delivery, best experience guaranteed.</p>
                    <a href="#products" class="btn-primary"
                        style="padding:16px 32px; font-size:16px; display:inline-flex; align-items:center; gap:9px; text-decoration:none;">
                        <i data-lucide="shopping-bag" style="width:18px; height:18px;"></i> Order Food Now
                    </a>
                </div>
                <div style="position:relative;">
                    <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=2081"
                        style="width:100%; border-radius:24px; box-shadow:0 24px 60px rgba(232,55,14,0.25);">
                    <div
                        style="position:absolute; top:-16px; right:-16px; width:80px; height:80px; border-radius:50%; background:#E8370E; display:flex; flex-direction:column; align-items:center; justify-content:center; font-family:'Syne',sans-serif; font-weight:800; color:#fff; font-size:14px; line-height:1.2; text-align:center;">
                        30%<br><span style="font-size:11px; font-weight:600;">OFF</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY CHOOSE US -->
    <section style="max-width:1280px; margin:0 auto; padding:80px 24px;">
        <div style="text-align:center; margin-bottom:56px;">
            <p
                style="color:#E8370E; font-family:'Syne',sans-serif; font-weight:700; font-size:14px; letter-spacing:.08em; text-transform:uppercase; margin:0 0 8px;">
                Our Promise</p>
            <h2 style="font-family:'Syne',sans-serif; font-size:40px; font-weight:800; margin:0 0 12px;">Why Choose Us</h2>
            <p style="color:#6B7280; font-size:16px; margin:0;">Best quality food and delivery service</p>
        </div>
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px;">
            @php
                $features = [
                    ['icon' => 'leaf', 'title' => 'Fresh Food', 'desc' => 'High quality fresh ingredients sourced daily from local farms.', 'color' => '#16A34A'],
                    ['icon' => 'truck', 'title' => 'Fast Delivery', 'desc' => 'Quick and safe delivery right at your doorstep in 30 minutes.', 'color' => '#2563EB'],
                    ['icon' => 'shield-check', 'title' => 'Secure Payment', 'desc' => '100% secure online payment with end-to-end encryption.', 'color' => '#7C3AED'],
                    ['icon' => 'star', 'title' => 'Best Quality', 'desc' => 'Premium taste with excellent 5-star customer service always.', 'color' => '#E8370E'],
                ];
            @endphp
            @foreach($features as $f)
                <div class="card"
                    style="padding:32px 24px; text-align:center; transition:transform .22s; border:1px solid #F0F0EC;"
                    onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div
                        style="width:60px; height:60px; background:{{ $f['color'] }}15; border-radius:16px; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
                        <i data-lucide="{{ $f['icon'] }}" style="width:26px; height:26px; color:{{ $f['color'] }};"></i>
                    </div>
                    <h3 style="font-family:'Syne',sans-serif; font-size:19px; font-weight:800; margin:0 0 10px;">
                        {{ $f['title'] }}</h3>
                    <p style="color:#6B7280; font-size:14px; line-height:1.7; margin:0;">{{ $f['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

@endsection