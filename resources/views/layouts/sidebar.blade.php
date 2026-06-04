{{-- <div id="sidebar">

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

    

    <!-- NAV -->
   
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
            
            
            <a href="/restaurant/order-offers" class="nav-link {{ str_contains($current, 'restaurant/order-offers') ? 'active' : '' }}">

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

</div> --}}


<style>
    /* Floating Menu */

    #sidebar{
        position:fixed;

        top:85px;
        left:30px;

        width:120px;

        max-height:75vh;

        background:#C25A2A;

        border-radius:50px;

        padding:15px 10px;

        display:none;
        flex-direction:column;
        align-items:center;
        gap:12px;

        overflow-y:auto;
        overflow-x:hidden;

        z-index:9999;

        box-shadow:
            0 10px 25px rgba(0,0,0,.12),
            0 4px 10px rgba(0,0,0,.08);
    }

    /* Open State */

    #sidebar.open{
        display:flex;
    }

    /* Hide Scrollbar */

    #sidebar::-webkit-scrollbar{
        width:0;
        height:0;
        display:none;
    }

    #sidebar{
        scrollbar-width:none;
        -ms-overflow-style:none;
    }

    /* Menu Items */

    .sidebar-item{
        width:100%;

        display:flex;
        flex-direction:column;
        align-items:center;

        text-decoration:none;

        color:#fff;

        padding:4px 0;

        transition:.25s ease;
    }

    /* Circular Icon */

    .sidebar-icon{
        width:58px;
        height:58px;

        border:2px solid rgba(255,255,255,.95);

        border-radius:50%;

        display:flex;
        align-items:center;
        justify-content:center;

        transition:.25s ease;
    }

    .sidebar-icon i{
        width:26px;
        height:26px;
    }

    /* Text */

    .sidebar-item span{
        margin-top:6px;

        font-size:11px;

        font-weight:600;

        text-align:center;

        line-height:1.2;
    }

    /* Hover */

    .sidebar-item:hover .sidebar-icon{
        background:#fff;
        color:#C25A2A;

        transform:translateY(-2px);
    }

    /* Active */

    .sidebar-item.active .sidebar-icon{
        background:#fff;
        color:#C25A2A;
    }

    .sidebar-item.active span{
        font-weight:700;
    }

    /* Logout Button */

    .sidebar-item button{
        all:unset;
    }

    /* Mobile */

    @media(max-width:768px){

        #sidebar{
            left:15px;
            top:75px;

            width:110px;

            max-height:65vh;
        }

        .sidebar-icon{
            width:52px;
            height:52px;
        }

        .sidebar-icon i{
            width:22px;
            height:22px;
        }

        .sidebar-item span{
            font-size:10px;
        }
    }
</style>


<div id="sidebar">

   

    @php $current = request()->path(); @endphp

    {{-- SUPER ADMIN --}}
    @if(auth()->user()->role == 'super_admin')

        <a href="/admin/dashboard"
           class="sidebar-item {{ str_contains($current,'admin/dashboard') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="layout-dashboard"></i>
            </div>
            <span>Dashboard</span>
        </a>

        <a href="/admin/restaurants"
           class="sidebar-item {{ str_contains($current,'admin/restaurants') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="store"></i>
            </div>
            <span>Restaurants</span>
        </a>

        <a href="/admin/products"
           class="sidebar-item {{ str_contains($current,'admin/products') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="package"></i>
            </div>
            <span>Products</span>
        </a>

        <a href="/admin/orders"
           class="sidebar-item {{ str_contains($current,'admin/orders') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="clipboard-list"></i>
            </div>
            <span>Orders</span>
        </a>

        <a href="/admin/users"
           class="sidebar-item {{ str_contains($current,'admin/users') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="users"></i>
            </div>
            <span>Users</span>
        </a>

    @endif

    {{-- RESTAURANT ADMIN --}}
    @if(auth()->user()->role == 'restaurant_admin')

        <a href="/restaurant/dashboard"
           class="sidebar-item {{ str_contains($current,'restaurant/dashboard') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="layout-dashboard"></i>
            </div>
            <span>Dashboard</span>
        </a>

        <a href="/restaurant/products"
           class="sidebar-item {{ str_contains($current,'restaurant/products') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="package"></i>
            </div>
            <span>Products</span>
        </a>

        <a href="/restaurant/categories"
           class="sidebar-item {{ str_contains($current,'restaurant/categories') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="grid-2x2"></i>
            </div>
            <span>Categories</span>
        </a>

        <a href="/restaurant/items"
           class="sidebar-item {{ str_contains($current,'restaurant/items') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="utensils-crossed"></i>
            </div>
            <span>Items</span>
        </a>

        <a href="/restaurant/order-offers"
           class="sidebar-item {{ str_contains($current,'restaurant/order-offers') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="badge-percent"></i>
            </div>
            <span>Offers</span>
        </a>

        <a href="/restaurant/reviews"
           class="sidebar-item {{ str_contains($current,'restaurant/reviews') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="star"></i>
            </div>
            <span>Reviews</span>
        </a>

        <a href="/restaurant/orders"
           class="sidebar-item {{ str_contains($current,'restaurant/orders') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="clipboard-list"></i>
            </div>
            <span>Orders</span>
        </a>

        <a href="/restaurant/payments"
           class="sidebar-item {{ str_contains($current,'restaurant/payments') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="credit-card"></i>
            </div>
            <span>Payments</span>
        </a>

        <a href="/restaurant/profile"
           class="sidebar-item {{ str_contains($current,'restaurant/profile') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="store"></i>
            </div>
            <span>Profile</span>
        </a>

    @endif

    {{-- VENDOR --}}
    @if(auth()->user()->role == 'vendor')

        <a href="/vendor/dashboard"
           class="sidebar-item {{ str_contains($current,'vendor/dashboard') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="layout-dashboard"></i>
            </div>
            <span>Dashboard</span>
        </a>

        <a href="/vendor/products"
           class="sidebar-item {{ str_contains($current,'vendor/products') ? 'active' : '' }}">
            <div class="sidebar-icon">
                <i data-lucide="package"></i>
            </div>
            <span>Products</span>
        </a>

    @endif

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="sidebar-item" style="background:none;border:none;cursor:pointer;">
            <div class="sidebar-icon">
                <i data-lucide="log-out"></i>
            </div>
            <span>Logout</span>
        </button>
    </form>

</div>

