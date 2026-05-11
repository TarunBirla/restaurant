@extends('front.layouts.app')

@section('content')

<!-- RESTAURANT HEADER BANNER -->
<section style="background:linear-gradient(135deg,#0D0D0D 0%,#1a1a1a 100%); padding:48px 0; border-bottom:3px solid #E8370E;">
    <div style="max-width:1280px; margin:0 auto; padding:0 24px;">
        <div style="display:flex; align-items:center; gap:20px; flex-wrap:wrap;">
            <div style="width:72px; height:72px; background:#E8370E; border-radius:18px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                <i data-lucide="utensils" style="width:32px; height:32px; color:#fff;"></i>
            </div>
            <div>
                <p style="color:#E8370E; font-family:'Poppins',sans-serif; font-weight:700; font-size:11px; letter-spacing:.12em; text-transform:uppercase; margin:0 0 4px;">Restaurant</p>
                <h1 style="font-family:'Poppins',sans-serif; font-size:32px; font-weight:800; color:#fff; margin:0; letter-spacing:-.4px;">
                    {{ $restaurant->name }}
                </h1>
                <p style="color:#9CA3AF; font-size:13px; margin:6px 0 0; display:flex; align-items:center; gap:6px;">
                    <i data-lucide="star" style="width:13px; height:13px; color:#FBBF24; fill:#FBBF24;"></i>
                    Most popular dishes today
                </p>
            </div>
        </div>
    </div>
</section>

<section style="background:#F5F5F0; padding:40px 0 80px;">
    <div style="max-width:1280px; margin:0 auto; padding:0 24px;">

        <!-- CATEGORY FILTER TABS -->
        <div style="display:flex; gap:10px; overflow-x:auto; margin-bottom:40px; padding-bottom:4px; scrollbar-width:none;">
            <style>.cat-scroll::-webkit-scrollbar{display:none;}</style>

            {{-- Active check: no category slug in URL = "All" is active --}}
            @php $activeCat = request()->segment(3); @endphp

            <a href="{{ url('/restaurant/' . $restaurant->slug) }}"
               style="padding:10px 22px; border-radius:40px; text-decoration:none; white-space:nowrap; font-weight:600; font-size:13px; font-family:'Poppins',sans-serif; transition:all .2s; flex-shrink:0;
                      {{ !$activeCat ? 'background:#E8370E; color:#fff; box-shadow:0 4px 14px rgba(232,55,14,.35);' : 'background:#fff; color:#374151; border:1.5px solid #E5E7EB;' }}">
                <span style="display:flex; align-items:center; gap:6px;">
                    <i data-lucide="grid-2x2" style="width:14px; height:14px;"></i> All
                </span>
            </a>

            @foreach($categories as $cat)
            <a href="{{ url('/restaurant/' . $restaurant->slug . '/' . $cat->slug) }}"
               style="padding:10px 22px; border-radius:40px; text-decoration:none; white-space:nowrap; font-weight:600; font-size:13px; font-family:'Poppins',sans-serif; transition:all .2s; flex-shrink:0;
                      {{ $activeCat === $cat->slug ? 'background:#E8370E; color:#fff; box-shadow:0 4px 14px rgba(232,55,14,.35);' : 'background:#fff; color:#374151; border:1.5px solid #E5E7EB;' }}"
               @if($activeCat !== $cat->slug)
               onmouseover="this.style.background='#FFF0EC'; this.style.borderColor='#E8370E'; this.style.color='#E8370E';"
               onmouseout="this.style.background='#fff'; this.style.borderColor='#E5E7EB'; this.style.color='#374151';"
               @endif>
                {{ $cat->name }}
            </a>
            @endforeach
        </div>

        <!-- SECTION LABEL -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:28px; flex-wrap:wrap; gap:10px;">
            <div>
                <p style="color:#E8370E; font-family:'Poppins',sans-serif; font-weight:700; font-size:11px; letter-spacing:.1em; text-transform:uppercase; margin:0 0 5px;">Today's Pick</p>
                <h2 style="font-family:'Poppins',sans-serif; font-size:28px; font-weight:800; margin:0; letter-spacing:-.3px; color:#0D0D0D;">
                    {{ $activeCat ? ($categories->firstWhere('slug', $activeCat)->name ?? 'Menu') : 'All Items' }}
                </h2>
            </div>
            <span style="background:#F0F0EC; padding:6px 16px; border-radius:999px; font-size:13px; font-weight:600; color:#6B7280;">
                {{ $products->count() }} {{ Str::plural('item', $products->count()) }}
            </span>
        </div>

        <!-- PRODUCTS GRID -->
        <div class="res-products-grid" style="display:grid; grid-template-columns:repeat(4,1fr); gap:22px;">
            @forelse($products as $product)
            <div style="background:#fff; border-radius:20px; overflow:hidden; box-shadow:0 2px 16px rgba(0,0,0,.07); border:1px solid #F0F0EC; transition:all .22s;"
                 onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 16px 40px rgba(0,0,0,.12)'"
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 16px rgba(0,0,0,.07)'">

                <div style="position:relative; overflow:hidden;">
                    <img src="{{ asset('storage/' . $product->image) }}"
                         style="width:100%; height:210px; object-fit:cover; transition:transform .5s; display:block;"
                         onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform='scale(1)'">
                    <div style="position:absolute; top:12px; left:12px;" class="badge-primary">
                        <span style="display:flex; align-items:center; gap:4px; font-size:11px;">
                            <i data-lucide="star" style="width:11px; height:11px; fill:#fff;"></i> Featured
                        </span>
                    </div>
                    <div style="position:absolute; top:12px; right:12px; background:rgba(255,255,255,0.95); border-radius:999px; padding:4px 12px;">
                        <span style="font-family:'Poppins',sans-serif; font-size:13px; font-weight:800; color:#E8370E;">€{{ $product->price }}</span>
                    </div>
                </div>

                <div style="padding:18px;">
                    <h3 style="font-family:'Poppins',sans-serif; font-weight:700; font-size:16px; margin:0 0 8px; line-height:1.35; color:#0D0D0D;">
                        {{ $product->name }}
                    </h3>
                    <p style="color:#6B7280; font-size:13px; line-height:1.6; margin:0 0 16px;">
                        {{ Str::limit($product->description, 75) }}
                    </p>
                    <div style="display:flex; gap:8px;">
                        <a href="/product/{{ $product->id }}" class="btn-black"
                           style="flex:1; text-align:center; padding:10px 0; font-size:13px; text-decoration:none;">View</a>
                        <form method="POST" action="/cart/add" style="flex:1;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="current_url" value="{{ url()->current() }}">
                            <button class="btn-primary" style="width:100%; padding:10px 0; font-size:13px; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:6px;">
                                <i data-lucide="shopping-cart" style="width:14px; height:14px;"></i> Add
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @empty
            <div style="grid-column:1/-1; text-align:center; padding:80px 20px; background:#fff; border-radius:20px; border:1px solid #F0F0EC;">
                <div style="width:80px; height:80px; background:#FFF0EC; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
                    <i data-lucide="package-x" style="width:36px; height:36px; color:#E8370E;"></i>
                </div>
                <h3 style="font-family:'Poppins',sans-serif; font-size:22px; font-weight:700; margin-bottom:10px; color:#0D0D0D;">No Products Found</h3>
                <p style="color:#6B7280; font-size:14px; margin:0 0 24px;">This category has no products available right now.</p>
                <a href="{{ url('/restaurant/' . $restaurant->slug) }}" class="btn-primary"
                   style="padding:12px 28px; font-size:14px; text-decoration:none; display:inline-flex; align-items:center; gap:8px;">
                    <i data-lucide="arrow-left" style="width:16px; height:16px;"></i> View All Items
                </a>
            </div>
            @endforelse
        </div>

    </div>
</section>

<style>
@media(max-width:900px){
    .res-products-grid{ grid-template-columns:repeat(2,1fr) !important; }
}
@media(max-width:560px){
    .res-products-grid{ grid-template-columns:1fr !important; }
}
</style>

@endsection