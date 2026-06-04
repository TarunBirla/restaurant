<div style="background:rgba(245, 240, 232, 0.95); border-bottom:1px solid #F0F0EC; padding:0 28px; height:68px; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:30;">

    <!-- LEFT: Mobile toggle + Page title -->
    <div style="display:flex; align-items:center; gap:14px;">

        <!-- Mobile menu toggle -->
        {{-- <button class="mobile-menu-btn" onclick="openSidebar()"
                style="display:none; align-items:center; justify-content:center; width:40px; height:40px; background:#F5F5F0; border:none; border-radius:10px; cursor:pointer;">
            <i data-lucide="menu" style="width:20px; height:20px;"></i>
        </button> --}}

        <button
            onclick="toggleSidebar()"
            style="
                width:52px;
                height:52px;
                border:none;
                border-radius:50%;
                background:#C25A2A;
                color:white;
                cursor:pointer;
                display:flex;
                align-items:center;
                justify-content:center;
            ">
            <i data-lucide="menu"></i>
        </button>

        <!-- Dynamic page title -->
        <div>
            <h1 style="font-family:'Poppins',sans-serif; font-size:20px; font-weight:700; color:#0D0D0D; margin:0; letter-spacing:-.3px;">
                @php
                    $path = request()->path();
                    $titles = [
                        'dashboard'  => 'Dashboard',
                        'products'   => 'Products',
                        'orders'     => 'Orders',
                        'categories' => 'Categories',
                        'users'      => 'Users',
                        'vendor'     => 'Vendors',
                        'restaurants'=> 'Restaurants',
                        'profile'    => 'Restaurant Profile',
                        'items'      => 'Menu Items',
                    ];
                    $pageTitle = 'Dashboard';
                    foreach($titles as $key => $label) {
                        if(str_contains($path, $key)) { $pageTitle = $label; break; }
                    }
                @endphp
                {{ $pageTitle }}
            </h1>
            <p style="font-size:12px; color:#9CA3AF; margin:1px 0 0; font-weight:400;">
                {{ now()->format('l, d M Y') }}
            </p>
        </div>
    </div>

    <!-- RIGHT: Notifications + User -->
    <div style="display:flex; align-items:center; gap:10px;">

        <!-- Notification Bell -->
        <button style="width:40px; height:40px; background:#F5F5F0; border:none; border-radius:10px; cursor:pointer; display:flex; align-items:center; justify-content:center; position:relative; transition:background .18s;"
                onmouseover="this.style.background='#EBEBEB'" onmouseout="this.style.background='#F5F5F0'">
            <i data-lucide="bell" style="width:18px; height:18px; color:#374151;"></i>
            <span style="position:absolute; top:8px; right:8px; width:8px; height:8px; background:#C25A2A; border-radius:50%; border:2px solid #fff;"></span>
        </button>

        <!-- Divider -->
        <div style="width:1px; height:28px; background:#F0F0EC;"></div>

        <!-- User Info -->
        <div style="display:flex; align-items:center; gap:10px; background:#F5F5F0; padding:7px 14px 7px 7px; border-radius:12px;">
            <div style="width:34px; height:34px; background:#C25A2A; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-family:'Poppins',sans-serif; font-weight:800; font-size:14px; color:#fff;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div style="display:none;" class="user-info-text">
                <p style="font-size:13px; font-weight:700; color:#0D0D0D; margin:0; line-height:1.3;">{{ auth()->user()->name }}</p>
                <p style="font-size:11px; color:#6B7280; margin:0; text-transform:capitalize;">{{ str_replace('_', ' ', auth()->user()->role) }}</p>
            </div>
        </div>
    </div>

</div>

<style>
@media(min-width:600px){
    .user-info-text { display:block !important; }
}
</style>