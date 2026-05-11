@extends('front.layouts.app')

@section('content')






    <section id="products" style="background:#fff; padding:30px 0;">
        <div style="max-width:1280px; margin:0 auto; padding:0 24px;">
            <div style="
            display:flex;
            gap:14px;
            overflow:auto;
            margin-bottom:35px;
            padding-bottom:10px;
        ">

                <a href="{{ url('/restaurant/' . $restaurant->slug) }}" style="
                padding:12px 24px;
                background:#111827;
                color:#fff;
                border-radius:40px;
                text-decoration:none;
                white-space:nowrap;
                font-weight:700;
               ">
                    All
                </a>

                @foreach($categories as $cat)

                    <a href="{{ url('/restaurant/' . $restaurant->slug . '/' . $cat->slug) }}" style="
                                padding:12px 24px;
                                background:#fff;
                                border:1px solid #E5E7EB;
                                color:#111827;
                                border-radius:40px;
                                text-decoration:none;
                                white-space:nowrap;
                                font-weight:700;
                                transition:.3s;
                               " onmouseover="this.style.background='#E8370E';this.style.color='#fff'"
                        onmouseout="this.style.background='#fff';this.style.color='#111827'">

                        {{ $cat->name }}

                    </a>

                @endforeach

            </div>
            <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:40px;">
                <div>
                    <p
                        style="color:#E8370E; font-family:'Syne',sans-serif; font-weight:700; font-size:14px; letter-spacing:.08em; text-transform:uppercase; margin:0 0 8px;">
                        Today's Pick</p>
                    <h2 style="font-family:'Syne',sans-serif; font-size:40px; font-weight:800; margin:0;">
                        {{ $restaurant->name }}
                    </h2>
                </div>
                <p style="color:#6B7280; font-size:15px;">Most popular dishes today</p>
            </div>
            <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:24px;">
                @forelse($products as $product)
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
                                    {{ $product->name }}
                                </h3>
                                <span
                                    style="font-family:'Syne',sans-serif; font-size:20px; font-weight:800; color:#E8370E; white-space:nowrap; margin-left:8px;">€{{ $product->price }}</span>
                            </div>
                            <p style="color:#6B7280; font-size:14px; line-height:1.6; margin:0 0 18px;">
                                {{ Str::limit($product->description, 80) }}
                            </p>
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
                @empty

                    <div
                        style="grid-column:1/-1; text-align:center; padding:80px 20px; background:#F9FAFB; border-radius:20px;">

                        <img src="https://cdn-icons-png.flaticon.com/512/6134/6134065.png"
                            style="width:120px; margin-bottom:20px; opacity:.7;">

                        <h3 style="font-family:'Syne',sans-serif; font-size:28px; margin-bottom:10px;">
                            No Products Found
                        </h3>

                        <p style="color:#6B7280; font-size:15px;">
                            This restaurant has no products available right now.
                        </p>

                    </div>

                @endforelse
            </div>
        </div>
    </section>


@endsection