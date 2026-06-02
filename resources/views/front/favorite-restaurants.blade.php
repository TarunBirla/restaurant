@extends('front.layouts.app')

@section('content')

<style>
    .favorites-page{
        background:rgba(245,240,232,.95);
        min-height:100vh;
        padding:32px 16px 100px;
    }

    .favorites-wrap{
        max-width:1100px;
        margin:0 auto;
        display:grid;
        grid-template-columns:260px 1fr;
        gap:24px;
    }

    .favorites-card{
        background:#fff;
        border-radius:24px;
        border:1px solid #E8E6E0;
        overflow:hidden;
    }

    .favorites-header{
        padding:28px 32px;
        border-bottom:1px solid #F0EDE8;
    }

    .favorites-header h1{
        margin:0;
        font-size:26px;
        font-weight:700;
    }

    .restaurant-item{
        display:flex;
        gap:16px;
        padding:20px;
        border-top:1px solid #F0EDE8;
        align-items:center;
    }

    .restaurant-item:first-child{
        border-top:none;
    }

    .restaurant-image{
        width:90px;
        height:90px;
        border-radius:16px;
        object-fit:cover;
        flex-shrink:0;
    }

    .restaurant-content{
        flex:1;
    }

    .restaurant-name{
        font-size:18px;
        font-weight:700;
        color:#111;
        margin-bottom:6px;
    }

    .restaurant-location{
        color:#777;
        font-size:14px;
        margin-bottom:8px;
    }

    .restaurant-rating{
        color:#F59E0B;
        font-size:14px;
        font-weight:600;
    }

    .view-btn{
        background:#111;
        color:#fff;
        text-decoration:none;
        padding:10px 18px;
        border-radius:12px;
        font-size:14px;
        font-weight:600;
    }

    .empty-state{
        text-align:center;
        padding:70px 20px;
    }

    .empty-state h3{
        margin:15px 0 8px;
    }

    .empty-state p{
        color:#888;
    }

    @media(max-width:900px){

        .favorites-wrap{
            grid-template-columns:1fr;
        }

    }

    @media(max-width:640px){

        .restaurant-item{
            flex-direction:column;
            align-items:flex-start;
        }

        .restaurant-image{
            width:100%;
            height:180px;
        }

        .view-btn{
            width:100%;
            text-align:center;
        }

    }
</style>

<div class="favorites-page">


<div class="favorites-wrap">

    <div>
        @include('front.layouts.user-sidebar')
    </div>

    <div>

        <div class="favorites-card">

            <div class="favorites-header">
                <h1>Favorite Restaurants</h1>
            </div>

            @forelse($restaurants as $restaurant)

                <div class="restaurant-item">

                    <img
                        src="{{ $restaurant->image ? asset('storage/'.$restaurant->image) : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1200&auto=format&fit=crop' }}"
                        class="restaurant-image">

                    <div class="restaurant-content">

                        <div class="restaurant-name">
                            {{ $restaurant->name }}
                        </div>

                        <div class="restaurant-location">
                            📍 {{ $restaurant->location }}
                        </div>

                        <div class="restaurant-rating">
                            ★ {{ number_format($restaurant->reviews->avg('rating') ?? 0,1) }}
                            ({{ $restaurant->reviews->count() }} Reviews)
                        </div>

                    </div>

                    <div style="
                        display:flex;
                        flex-direction:column;
                        gap:10px;
                    ">

                        <a
                            href="{{ url('/restaurant/'.$restaurant->slug) }}"
                            class="view-btn">
                            View Menu
                        </a>

                        <form
                            action="{{ route('favorite.remove',$restaurant->id) }}"
                            method="POST"
                            onsubmit="return confirm('Remove from favorites?')">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                style="
                                    width:100%;
                                    background:#FEE2E2;
                                    color:#B91C1C;
                                    border:none;
                                    padding:10px 18px;
                                    border-radius:12px;
                                    font-size:14px;
                                    font-weight:600;
                                    cursor:pointer;
                                ">
                                ❤️ Remove
                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="empty-state">

                    <div style="font-size:60px;">❤️</div>

                    <h3>No Favorite Restaurants</h3>

                    <p>
                        Restaurants you add to favorites
                        will appear here.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>


</div>

@endsection
