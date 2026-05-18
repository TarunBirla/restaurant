@extends('front.layouts.app')

@section('content')


    <section style="background:#F8F9FA; padding:20px 0; min-height:100vh;">

        <div style="max-width:1300px; margin:auto; padding:0 20px;">

            <div style="text-align:center; margin-bottom:50px;">

                <h1 style="
                            font-size:48px;
                            font-weight:800;
                            margin-bottom:10px;
                            color:#111827;
                            font-family:'Syne',sans-serif;
                        ">
                    Explore Restaurants
                </h1>

                <p style="
                            color:#6B7280;
                            font-size:17px;
                        ">
                    Discover your favorite foods & restaurants
                </p>

            </div>


            @if($nearbyRestaurants->count())

                <h2 style="
                            font-size:34px;
                            font-weight:800;
                            margin-bottom:25px;
                            color:#111827;
                        ">
                    🔥 Nearby Restaurants
                </h2>

                <div style="
                            display:grid;
                            grid-template-columns:repeat(auto-fit,minmax(280px,3fr));
                            gap:30px;
                            margin-bottom:60px;
                        ">

                    @foreach($nearbyRestaurants as $restaurant)

                        <div style="
                                                            background:#fff;
                                                            border-radius:24px;
                                                            overflow:hidden;
                                                            box-shadow:0 10px 30px rgba(0,0,0,0.08);
                                                            transition:0.3s;
                                                            border:1px solid #F1F1F1;
                                                        " onmouseover="this.style.transform='translateY(-8px)'"
                            onmouseout="this.style.transform='translateY(0)'">

                            <div style="
                                                                position:relative;
                                                                overflow:hidden;
                                                            ">

                                <img src="{{ $restaurant->image ? asset('storage/' . $restaurant->image) : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1200&auto=format&fit=crop' }}"
                                    style="
                                                                        width:100%;
                                                                        height:230px;
                                                                        object-fit:cover;
                                                                    ">

                                <div style="
                                                                    position:absolute;
                                                                    top:15px;
                                                                    left:15px;
                                                                    background:#E63946;
                                                                    color:#fff;
                                                                    padding:6px 14px;
                                                                    border-radius:30px;
                                                                    font-size:13px;
                                                                    font-weight:600;
                                                                ">
                                    Open Now
                                </div>

                            </div>

                            <div style="padding:24px;">

                                <div style="
                                                                    display:flex;
                                                                    justify-content:space-between;
                                                                    align-items:center;
                                                                    margin-bottom:12px;
                                                                ">

                                    <h3 style="
                                                                        margin:0;
                                                                        font-size:24px;
                                                                        font-weight:800;
                                                                        color:#111827;
                                                                        font-family:'Syne',sans-serif;
                                                                    ">
                                        {{ $restaurant->name }}
                                    </h3>

                                    <div style="
                                                                        background:#FFF3E6;
                                                                        color:#FF9500;
                                                                        padding:5px 10px;
                                                                        border-radius:20px;
                                                                        font-size:13px;
                                                                        font-weight:700;
                                                                    ">
                                        ★ 4.5
                                    </div>

                                </div>

                                <p style="
                                                                    color:#6B7280;
                                                                    margin-bottom:20px;
                                                                    line-height:1.7;
                                                                    font-size:14px;
                                                                ">
                                    {{ $restaurant->description ?? 'Delicious food & fast delivery available.' }}
                                </p>

                                <div style="
                                                                    display:flex;
                                                                    justify-content:space-between;
                                                                    align-items:center;
                                                                    margin-bottom:22px;
                                                                ">

                                    <div style="
                                                                        display:flex;
                                                                        align-items:center;
                                                                        gap:6px;
                                                                        color:#6B7280;
                                                                        font-size:14px;
                                                                    ">
                                        📍 {{ $restaurant->location }}
                                    </div>

                                    <div style="
                                                                        color:#10B981;
                                                                        font-weight:700;
                                                                        font-size:14px;
                                                                    ">
                                        Free Delivery
                                    </div>

                                </div>

                                <a href="{{ url('/restaurant/' . $restaurant->slug) }}" style="
                                                                        display:block;
                                                                        width:100%;
                                                                        background:#111827;
                                                                        color:#fff;
                                                                        text-align:center;
                                                                        padding:14px;
                                                                        border-radius:14px;
                                                                        text-decoration:none;
                                                                        font-weight:700;
                                                                        transition:0.3s;
                                                                    " onmouseover="this.style.background='#E63946'"
                                    onmouseout="this.style.background='#111827'">

                                    View Menu

                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

            <h2 style="
                font-size:34px;
                font-weight:800;
                margin-bottom:25px;
                color:#111827;
            ">
                🍴 Other Restaurants
            </h2>
            <div style="
                        display:grid;
                        grid-template-columns:repeat(auto-fit,minmax(280px,3fr));
                        gap:30px;
                    ">

                @forelse($otherRestaurants as $restaurant)

                    <div style="
                                            background:#fff;
                                            border-radius:24px;
                                            overflow:hidden;
                                            box-shadow:0 10px 30px rgba(0,0,0,0.08);
                                            transition:0.3s;
                                            border:1px solid #F1F1F1;
                                        " onmouseover="this.style.transform='translateY(-8px)'"
                        onmouseout="this.style.transform='translateY(0)'">

                        <div style="
                                                position:relative;
                                                overflow:hidden;
                                            ">

                            <img src="{{ $restaurant->image ? asset('storage/' . $restaurant->image) : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1200&auto=format&fit=crop' }}"
                                style="
                                                        width:100%;
                                                        height:230px;
                                                        object-fit:cover;
                                                    ">

                            <div style="
                                                    position:absolute;
                                                    top:15px;
                                                    left:15px;
                                                    background:#E63946;
                                                    color:#fff;
                                                    padding:6px 14px;
                                                    border-radius:30px;
                                                    font-size:13px;
                                                    font-weight:600;
                                                ">
                                Open Now
                            </div>

                        </div>

                        <div style="padding:24px;">

                            <div style="
                                                    display:flex;
                                                    justify-content:space-between;
                                                    align-items:center;
                                                    margin-bottom:12px;
                                                ">

                                <h3 style="
                                                        margin:0;
                                                        font-size:24px;
                                                        font-weight:800;
                                                        color:#111827;
                                                        font-family:'Syne',sans-serif;
                                                    ">
                                    {{ $restaurant->name }}
                                </h3>

                                <div style="
                                                        background:#FFF3E6;
                                                        color:#FF9500;
                                                        padding:5px 10px;
                                                        border-radius:20px;
                                                        font-size:13px;
                                                        font-weight:700;
                                                    ">
                                    ★ 4.5
                                </div>

                            </div>

                            <p style="
                                                    color:#6B7280;
                                                    margin-bottom:20px;
                                                    line-height:1.7;
                                                    font-size:14px;
                                                ">
                                {{ $restaurant->description ?? 'Delicious food & fast delivery available.' }}
                            </p>

                            <div style="
                                                    display:flex;
                                                    justify-content:space-between;
                                                    align-items:center;
                                                    margin-bottom:22px;
                                                ">

                                <div style="
                                                        display:flex;
                                                        align-items:center;
                                                        gap:6px;
                                                        color:#6B7280;
                                                        font-size:14px;
                                                    ">
                                    📍 {{ $restaurant->location }}
                                </div>

                                <div style="
                                                        color:#10B981;
                                                        font-weight:700;
                                                        font-size:14px;
                                                    ">
                                    Free Delivery
                                </div>

                            </div>

                            <a href="{{ url('/restaurant/' . $restaurant->slug) }}" style="
                                                        display:block;
                                                        width:100%;
                                                        background:#111827;
                                                        color:#fff;
                                                        text-align:center;
                                                        padding:14px;
                                                        border-radius:14px;
                                                        text-decoration:none;
                                                        font-weight:700;
                                                        transition:0.3s;
                                                    " onmouseover="this.style.background='#E63946'"
                                onmouseout="this.style.background='#111827'">

                                View Menu

                            </a>

                        </div>

                    </div>

                @empty

                    <div style="
                                            grid-column:1/-1;
                                            text-align:center;
                                            background:#fff;
                                            padding:80px 20px;
                                            border-radius:24px;
                                            box-shadow:0 5px 20px rgba(0,0,0,0.06);
                                        ">

                        <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" style="
                                                    width:120px;
                                                    margin-bottom:25px;
                                                    opacity:0.8;
                                                ">

                        <h2 style="
                                                font-size:34px;
                                                margin-bottom:10px;
                                                color:#111827;
                                                font-family:'Syne',sans-serif;
                                            ">
                            No Restaurants Found
                        </h2>

                        <p style="
                                                color:#6B7280;
                                                font-size:16px;
                                            ">
                            Restaurants will appear here soon.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </section>



@endsection