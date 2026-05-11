@extends('front.layouts.app')

@section('content')



<!-- PRODUCT DETAIL -->
<section style="background:#F5F5F0; padding:60px 0 80px;">
    <div style="max-width:1280px; margin:0 auto; padding:0 24px;">

        <div class="product-detail-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start;">

            <!-- IMAGE SIDE -->
            <div>
                <div style="border-radius:24px; overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,.12); position:relative; background:#fff;">
                    <img src="{{ asset('storage/' . $product->image) }}"
                         style="width:100%; aspect-ratio:4/3; object-fit:cover; display:block; transition:transform .6s;"
                         onmouseover="this.style.transform='scale(1.04)'" onmouseout="this.style.transform='scale(1)'">
                    <div style="position:absolute; top:16px; left:16px;" class="badge-primary">
                        <span style="display:flex; align-items:center; gap:5px; font-size:12px; padding:4px 2px;">
                            <i data-lucide="star" style="width:12px; height:12px; fill:#fff;"></i> Featured
                        </span>
                    </div>
                </div>

                <!-- QUICK INFO CHIPS -->
                <div style="display:flex; gap:10px; margin-top:18px; flex-wrap:wrap;">
                    <div style="display:flex; align-items:center; gap:8px; background:#fff; padding:10px 16px; border-radius:12px; border:1px solid #F0F0EC; flex:1; min-width:120px;">
                        <i data-lucide="clock" style="width:16px; height:16px; color:#E8370E; flex-shrink:0;"></i>
                        <div>
                            <p style="font-size:10px; color:#9CA3AF; margin:0; font-weight:500; text-transform:uppercase; letter-spacing:.05em;">Delivery</p>
                            <p style="font-size:13px; font-weight:700; margin:0; font-family:'Poppins',sans-serif;">30 min</p>
                        </div>
                    </div>
                    <div style="display:flex; align-items:center; gap:8px; background:#fff; padding:10px 16px; border-radius:12px; border:1px solid #F0F0EC; flex:1; min-width:120px;">
                        <i data-lucide="star" style="width:16px; height:16px; color:#FBBF24; fill:#FBBF24; flex-shrink:0;"></i>
                        <div>
                            <p style="font-size:10px; color:#9CA3AF; margin:0; font-weight:500; text-transform:uppercase; letter-spacing:.05em;">Rating</p>
                            <p style="font-size:13px; font-weight:700; margin:0; font-family:'Poppins',sans-serif;">4.9 / 5</p>
                        </div>
                    </div>
                    <div style="display:flex; align-items:center; gap:8px; background:#fff; padding:10px 16px; border-radius:12px; border:1px solid #F0F0EC; flex:1; min-width:120px;">
                        <i data-lucide="leaf" style="width:16px; height:16px; color:#16A34A; flex-shrink:0;"></i>
                        <div>
                            <p style="font-size:10px; color:#9CA3AF; margin:0; font-weight:500; text-transform:uppercase; letter-spacing:.05em;">Quality</p>
                            <p style="font-size:13px; font-weight:700; margin:0; font-family:'Poppins',sans-serif;">Fresh</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTENT SIDE -->
            <div>

                <!-- CATEGORY TAG -->
                @if($product->category)
                <div style="display:inline-flex; align-items:center; gap:6px; background:#FFF0EC; border:1px solid rgba(232,55,14,0.2); padding:6px 14px; border-radius:999px; margin-bottom:18px;">
                    <i data-lucide="tag" style="width:12px; height:12px; color:#E8370E;"></i>
                    <span style="font-size:12px; font-weight:600; color:#E8370E; font-family:'Poppins',sans-serif;">{{ $product->category->name }}</span>
                </div>
                @endif

                <h1 style="font-family:'Poppins',sans-serif; font-size:36px; font-weight:800; color:#0D0D0D; margin:0 0 14px; line-height:1.2; letter-spacing:-.5px;">
                    {{ $product->name }}
                </h1>

                <!-- PRICE -->
                <div style="display:flex; align-items:baseline; gap:10px; margin-bottom:24px;">
                    <span style="font-family:'Poppins',sans-serif; font-size:42px; font-weight:800; color:#E8370E; line-height:1;">
                        €{{ $product->price }}
                    </span>
                    <span style="font-size:14px; color:#9CA3AF; font-weight:500;">per serving</span>
                </div>

                <!-- DIVIDER -->
                <div style="height:1px; background:#F0F0EC; margin-bottom:24px;"></div>

                <!-- DESCRIPTION -->
                <div style="margin-bottom:32px;">
                    <h3 style="font-family:'Poppins',sans-serif; font-size:15px; font-weight:700; color:#0D0D0D; margin:0 0 12px;">About this dish</h3>
                    <p style="color:#6B7280; font-size:15px; line-height:1.85; margin:0;">
                        {{ $product->description }}
                    </p>
                </div>

                <!-- WHY CHOOSE BADGES -->
                <div style="display:flex; flex-direction:column; gap:10px; margin-bottom:36px;">
                    <div style="display:flex; align-items:center; gap:12px; background:#F9FAFB; padding:12px 16px; border-radius:12px; border:1px solid #F0F0EC;">
                        <div style="width:34px; height:34px; background:#DCFCE7; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <i data-lucide="shield-check" style="width:16px; height:16px; color:#16A34A;"></i>
                        </div>
                        <div>
                            <p style="font-size:13px; font-weight:700; margin:0; font-family:'Poppins',sans-serif;">100% Fresh Ingredients</p>
                            <p style="font-size:12px; color:#6B7280; margin:2px 0 0;">Sourced daily from local suppliers</p>
                        </div>
                    </div>
                    <div style="display:flex; align-items:center; gap:12px; background:#F9FAFB; padding:12px 16px; border-radius:12px; border:1px solid #F0F0EC;">
                        <div style="width:34px; height:34px; background:#EFF6FF; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <i data-lucide="truck" style="width:16px; height:16px; color:#2563EB;"></i>
                        </div>
                        <div>
                            <p style="font-size:13px; font-weight:700; margin:0; font-family:'Poppins',sans-serif;">Fast Delivery Guaranteed</p>
                            <p style="font-size:12px; color:#6B7280; margin:2px 0 0;">Arrives hot and fresh at your door</p>
                        </div>
                    </div>
                </div>

                <!-- ADD TO CART FORM -->
                <form method="POST" action="/cart/add">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="current_url" value="{{ url()->current() }}">

                    <div style="display:flex; gap:12px; flex-wrap:wrap;">
                        <button class="btn-primary" type="submit"
                                style="flex:2; padding:16px 24px; font-size:16px; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:10px; letter-spacing:.02em; min-width:180px;">
                            <i data-lucide="shopping-cart" style="width:18px; height:18px;"></i>
                            Add To Cart
                        </button>
                        <a href="javascript:history.back()"
                           style="flex:1; padding:16px 20px; font-size:15px; font-family:'Poppins',sans-serif; font-weight:600; border:2px solid #E5E7EB; border-radius:12px; color:#374151; text-decoration:none; display:flex; align-items:center; justify-content:center; gap:8px; transition:all .18s; min-width:100px;"
                           onmouseover="this.style.borderColor='#0D0D0D'; this.style.background='#0D0D0D'; this.style.color='#fff';"
                           onmouseout="this.style.borderColor='#E5E7EB'; this.style.background='transparent'; this.style.color='#374151';">
                            <i data-lucide="arrow-left" style="width:16px; height:16px;"></i> Back
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<style>
@media(max-width:900px){
    .product-detail-grid{
        grid-template-columns: 1fr !important;
        gap: 32px !important;
    }
}
</style>

@endsection