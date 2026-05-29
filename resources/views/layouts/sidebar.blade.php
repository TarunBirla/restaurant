<div id="sidebar">

    <!-- LOGO -->
    <div style="padding: 24px 20px; border-bottom: 1px solid #1F1F1F;">
        <a href="/" style="display:flex; align-items:center; gap:10px; text-decoration:none;">
            <div
                style="width:38px; height:38px; background:#C25A2A; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                <i data-lucide="utensils" style="color:#fff; width:20px; height:20px;"></i>
            </div>
            <span
                style="font-family:'Poppins',sans-serif; font-weight:800; font-size:18px; color:#fff; letter-spacing:-.3px;">
                HYST
            </span>
        </a>
    </div>

    <!-- USER BADGE -->
    <!-- <div style="padding: 18px 20px; border-bottom: 1px solid #1F1F1F;">
        <div style="display:flex; align-items:center; gap:11px;">
            <div
                style="width:40px; height:40px; background:#C25A2A; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-family:'Poppins',sans-serif; font-weight:800; font-size:16px; color:#fff;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div style="overflow:hidden;">
                <p
                    style="font-size:14px; font-weight:700; color:#fff; margin:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    {{ auth()->user()->name }}
                </p>
                <span
                    style="font-size:11px; font-weight:600; color:#C25A2A; background:rgba(232,55,14,.15); padding:2px 10px; border-radius:999px; display:inline-block; margin-top:3px; text-transform:capitalize; letter-spacing:.04em;">
                    {{ str_replace('_', ' ', auth()->user()->role) }}
                </span>
            </div>
        </div>
    </div> -->

    <!-- NAV -->
    <!-- <div style="flex:1; overflow-y:auto; padding: 16px 12px;"> -->
    <div style="
    flex:1;
    overflow-y:auto;
    overflow-x:hidden;
    padding:16px 12px;
    scrollbar-width:thin;
">

        @php $current = request()->path(); @endphp

        <!-- ── SUPER ADMIN ── -->
        @if(auth()->user()->role == 'super_admin')

            <p
                style="font-size:10px; font-weight:700; color:#4B5563; text-transform:uppercase; letter-spacing:.1em; padding:0 8px; margin:0 0 10px;">
                Main</p>

            <a href="/admin/dashboard" class="nav-link {{ str_contains($current, 'admin/dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard" class="nav-icon"></i> Dashboard
            </a>
            <a href="/admin/restaurants" class="nav-link {{ str_contains($current, 'admin/restaurants') ? 'active' : '' }}">
                <i data-lucide="store" class="nav-icon"></i> Restaurants
            </a>
            <!-- <a href="/admin/vendor" class="nav-link {{ str_contains($current, 'admin/vendor') ? 'active' : '' }}">
                    <i data-lucide="users" class="nav-icon"></i> Vendors
                </a> -->

            <p
                style="font-size:10px; font-weight:700; color:#4B5563; text-transform:uppercase; letter-spacing:.1em; padding:0 8px; margin:18px 0 10px;">
                Catalog</p>


            <a href="/admin/products" class="nav-link {{ str_contains($current, 'admin/products') ? 'active' : '' }}">
                <i data-lucide="package" class="nav-icon"></i> Products
            </a>

            <p
                style="font-size:10px; font-weight:700; color:#4B5563; text-transform:uppercase; letter-spacing:.1em; padding:0 8px; margin:18px 0 10px;">
                Manage</p>

            <a href="/admin/orders" class="nav-link {{ str_contains($current, 'admin/orders') ? 'active' : '' }}">
                <i data-lucide="clipboard-list" class="nav-icon"></i> Orders
            </a>
            <a href="/admin/users" class="nav-link {{ str_contains($current, 'admin/users') ? 'active' : '' }}">
                <i data-lucide="user-cog" class="nav-icon"></i> Users
            </a>

        @endif

        <!-- ── RESTAURANT ADMIN ── -->
        @if(auth()->user()->role == 'restaurant_admin')

            <p
                style="font-size:10px; font-weight:700; color:#4B5563; text-transform:uppercase; letter-spacing:.1em; padding:0 8px; margin:0 0 10px;">
                Main</p>

            <a href="/restaurant/dashboard"
                class="nav-link {{ str_contains($current, 'restaurant/dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard" class="nav-icon"></i> Dashboard
            </a>

            <p
                style="font-size:10px; font-weight:700; color:#4B5563; text-transform:uppercase; letter-spacing:.1em; padding:0 8px; margin:18px 0 10px;">
                Menu</p>

            <a href="/restaurant/products"
                class="nav-link {{ str_contains($current, 'restaurant/products') ? 'active' : '' }}">
                <i data-lucide="package" class="nav-icon"></i> My Products
            </a>
            <a href="/restaurant/categories"
                class="nav-link {{ str_contains($current, 'restaurant/categories') ? 'active' : '' }}">
                <i data-lucide="grid-2x2" class="nav-icon"></i> Categories
            </a>
            <a href="/restaurant/items" class="nav-link {{ str_contains($current, 'restaurant/items') ? 'active' : '' }}">
                <i data-lucide="utensils-crossed" class="nav-icon"></i> Items
            </a>
            <a href="/restaurant/offers" class="nav-link {{ str_contains($current, 'restaurant/offers') ? 'active' : '' }}">

                <i data-lucide="badge-percent" class="nav-icon"></i>

                Offers & Discounts

            </a>
            <a href="/restaurant/reviews"
                class="nav-link {{ str_contains($current, 'restaurant/reviews') ? 'active' : '' }}">

                <i data-lucide="star" class="nav-icon"></i>

                Reviews

            </a>

            <p
                style="font-size:10px; font-weight:700; color:#4B5563; text-transform:uppercase; letter-spacing:.1em; padding:0 8px; margin:18px 0 10px;">
                Manage</p>

            <a href="/restaurant/orders" class="nav-link {{ str_contains($current, 'restaurant/orders') ? 'active' : '' }}">
                <i data-lucide="clipboard-list" class="nav-icon"></i> Orders
            </a>
            <a href="/restaurant/payments"
                class="nav-link {{ str_contains($current, 'restaurant/payments') ? 'active' : '' }}">

                <i data-lucide="credit-card" class="nav-icon"></i>

                Payments

            </a>
            <a href="/restaurant/profile"
                class="nav-link {{ str_contains($current, 'restaurant/profile') ? 'active' : '' }}">
                <i data-lucide="store" class="nav-icon"></i> Restaurant Profile
            </a>

        @endif

        <!-- ── VENDOR ── -->
        @if(auth()->user()->role == 'vendor')

            <p
                style="font-size:10px; font-weight:700; color:#4B5563; text-transform:uppercase; letter-spacing:.1em; padding:0 8px; margin:0 0 10px;">
                Main</p>

            <a href="/vendor/dashboard" class="nav-link {{ str_contains($current, 'vendor/dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard" class="nav-icon"></i> Dashboard
            </a>
            <a href="/vendor/products" class="nav-link {{ str_contains($current, 'vendor/products') ? 'active' : '' }}">
                <i data-lucide="package" class="nav-icon"></i> My Products
            </a>

        @endif

    </div>

    <!-- LOGOUT -->
    <div style="padding: 12px; border-top: 1px solid #1F1F1F;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                style="width:100%; display:flex; align-items:center; gap:11px; padding:11px 18px; border-radius:12px; background:none; border:none; cursor:pointer; font-family:'Poppins',sans-serif; font-size:14px; font-weight:500; color:#9CA3AF; transition:all .18s; text-align:left;"
                onmouseover="this.style.background='rgba(232,55,14,.15)'; this.style.color='#C25A2A';"
                onmouseout="this.style.background='none'; this.style.color='#9CA3AF';">
                <i data-lucide="log-out" style="width:18px; height:18px; flex-shrink:0;"></i>
                Logout
            </button>
        </form>
    </div>

</div>