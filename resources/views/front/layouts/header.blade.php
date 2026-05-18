<header style="background:#fff; box-shadow:0 1px 0 #F0F0EC; position:sticky; top:0; z-index:100;">
    <div style=" margin:0 auto; padding:0 24px;" class="mx-auto max-w-7xl">
        <div style="display:flex; align-items:center; justify-content:space-between; height:68px;">

            <!-- LOGO -->
            <a href="/" style="display:flex; align-items:center; gap:10px; text-decoration:none;">
                <div
                    style="width:38px; height:38px; background:#E8370E; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i data-lucide="utensils" style="color:#fff; width:20px; height:20px;"></i>
                </div>
                <span
                    style="font-family:'Poppins',sans-serif; font-weight:800; font-size:20px; color:#0D0D0D; letter-spacing:-.3px;">
                    HYST
                </span>
            </a>

            <!-- DESKTOP NAV -->
            <nav class="desktop-nav" style="align-items:center; gap:4px;">
                <a href="/"
                    style="padding:8px 15px; border-radius:10px; font-weight:500; font-size:14px; color:#0D0D0D; text-decoration:none; transition:background .18s;"
                    onmouseover="this.style.background='#F5F5F0'"
                    onmouseout="this.style.background='transparent'">Home</a>

                <a href="/restaurants"
                    style="padding:8px 15px; border-radius:10px; font-weight:500; font-size:14px; color:#0D0D0D; text-decoration:none; display:flex; align-items:center; gap:6px; transition:background .18s;"
                    onmouseover="this.style.background='#F5F5F0'" onmouseout="this.style.background='transparent'">
                    <i data-lucide="package" style="width:16px; height:16px;"></i> Restaurants
                </a>


                @auth
                    <a href="/cart"
                        style="padding:8px 15px; border-radius:10px; font-weight:500; font-size:14px; color:#0D0D0D; text-decoration:none; display:flex; align-items:center; gap:6px; transition:background .18s;"
                        onmouseover="this.style.background='#F5F5F0'" onmouseout="this.style.background='transparent'">
                        <i data-lucide="shopping-cart" style="width:16px; height:16px;"></i> Cart
                    </a>
                    <a href="/my-orders"
                        style="padding:8px 15px; border-radius:10px; font-weight:500; font-size:14px; color:#0D0D0D; text-decoration:none; display:flex; align-items:center; gap:6px; transition:background .18s;"
                        onmouseover="this.style.background='#F5F5F0'" onmouseout="this.style.background='transparent'">
                        <i data-lucide="package" style="width:16px; height:16px;"></i> Orders
                    </a>


                    <!-- USER DROPDOWN -->
                    <div style="position:relative;"
                        onmouseenter="document.getElementById('userDropdown').style.display='block'"
                        onmouseleave="document.getElementById('userDropdown').style.display='none'">
                        <button
                            style="display:flex; align-items:center; gap:9px; background:#F5F5F0; border:none; padding:7px 13px 7px 7px; border-radius:12px; cursor:pointer; transition:background .18s;"
                            onmouseover="this.style.background='#EBEBEB'" onmouseout="this.style.background='#F5F5F0'">
                            <div class="avatar" style="width:34px; height:34px; font-size:14px;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div style="text-align:left;">
                                <p
                                    style="font-family:'Poppins',sans-serif; font-weight:700; font-size:13px; margin:0; line-height:1.3;">
                                    {{ auth()->user()->name }}</p>
                                <p style="font-size:10px; color:#6B7280; margin:0; text-transform:capitalize;">
                                    {{ auth()->user()->role }}</p>
                            </div>
                            <i data-lucide="chevron-down" style="width:14px; height:14px; color:#6B7280;"></i>
                        </button>

                        <div id="userDropdown"
                            style="display:none; position:absolute; right:0; top:100%; margin-top:8px; width:210px; background:#fff; border-radius:16px; box-shadow:0 16px 48px rgba(0,0,0,.14); overflow:hidden; z-index:200; border:1px solid #F0F0EC;">
                            <a href="/dashboard"
                                style="display:flex; align-items:center; gap:10px; padding:13px 17px; text-decoration:none; color:#0D0D0D; font-size:13px; font-weight:500; transition:background .15s;"
                                onmouseover="this.style.background='#F5F5F0'" onmouseout="this.style.background='#fff'">
                                <i data-lucide="layout-dashboard" style="width:15px; height:15px; color:#E8370E;"></i>
                                Dashboard
                            </a>
                            <a href="/profile"
                                style="display:flex; align-items:center; gap:10px; padding:13px 17px; text-decoration:none; color:#0D0D0D; font-size:13px; font-weight:500; transition:background .15s;"
                                onmouseover="this.style.background='#F5F5F0'" onmouseout="this.style.background='#fff'">
                                <i data-lucide="user" style="width:15px; height:15px; color:#E8370E;"></i> My Profile
                            </a>
                            <a href="/my-orders"
                                style="display:flex; align-items:center; gap:10px; padding:13px 17px; text-decoration:none; color:#0D0D0D; font-size:13px; font-weight:500; transition:background .15s;"
                                onmouseover="this.style.background='#F5F5F0'" onmouseout="this.style.background='#fff'">
                                <i data-lucide="package" style="width:15px; height:15px; color:#E8370E;"></i> My Orders
                            </a>
                            <a href="/cart"
                                style="display:flex; align-items:center; gap:10px; padding:13px 17px; text-decoration:none; color:#0D0D0D; font-size:13px; font-weight:500; transition:background .15s;"
                                onmouseover="this.style.background='#F5F5F0'" onmouseout="this.style.background='#fff'">
                                <i data-lucide="shopping-cart" style="width:15px; height:15px; color:#E8370E;"></i> Cart
                            </a>
                            <div style="border-top:1px solid #F0F0EC; margin:4px 0;"></div>
                            <form method="POST" action="/logout">
                                @csrf
                                <button
                                    style="display:flex; align-items:center; gap:10px; padding:13px 17px; width:100%; background:none; border:none; cursor:pointer; font-size:13px; font-weight:600; color:#E8370E; transition:background .15s; font-family:'Poppins',sans-serif;"
                                    onmouseover="this.style.background='#FFF0EC'"
                                    onmouseout="this.style.background='transparent'">
                                    <i data-lucide="log-out" style="width:15px; height:15px;"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

                @guest
                    <a href="/login" class="btn-black"
                        style="padding:9px 18px; font-size:13px; margin-left:4px; display:flex; align-items:center; gap:7px; text-decoration:none;">
                        <i data-lucide="log-in" style="width:15px; height:15px;"></i> Login
                    </a>
                    <a href="/register" class="btn-primary"
                        style="padding:9px 18px; font-size:13px; display:flex; align-items:center; gap:7px; text-decoration:none;">
                        <i data-lucide="user-plus" style="width:15px; height:15px;"></i> Register
                    </a>
                @endguest
            </nav>

            <!-- MOBILE TOGGLE -->
            <button class="mobile-toggle" onclick="toggleMobileMenu()" aria-label="Menu">
                <i data-lucide="menu" style="width:22px; height:22px;"></i>
            </button>
        </div>
    </div>

    <!-- MOBILE MENU -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="/"><i data-lucide="home" style="width:18px; height:18px; color:#E8370E;"></i> Home</a>

        @auth
            <a href="/cart"><i data-lucide="shopping-cart" style="width:18px; height:18px; color:#E8370E;"></i> Cart</a>
            <a href="/my-orders"><i data-lucide="package" style="width:18px; height:18px; color:#E8370E;"></i> My Orders</a>
            <a href="/dashboard"><i data-lucide="layout-dashboard" style="width:18px; height:18px; color:#E8370E;"></i>
                Dashboard</a>
            <a href="/profile"><i data-lucide="user" style="width:18px; height:18px; color:#E8370E;"></i> My Profile</a>
            <form method="POST" action="/logout" style="border-bottom:none;">
                @csrf
                <button
                    style="display:flex; align-items:center; gap:10px; width:100%; background:none; border:none; padding:13px 0; font-size:14px; font-weight:600; color:#E8370E; cursor:pointer; font-family:'Poppins',sans-serif; border-bottom:none;">
                    <i data-lucide="log-out" style="width:18px; height:18px;"></i> Logout
                </button>
            </form>
        @endauth

        @guest
            <a href="/login"><i data-lucide="log-in" style="width:18px; height:18px; color:#E8370E;"></i> Login</a>
            <a href="/register"><i data-lucide="user-plus" style="width:18px; height:18px; color:#E8370E;"></i> Register</a>
        @endguest
    </div>
</header>

<script>
    function toggleMobileMenu() {
        document.getElementById('mobileMenu').classList.toggle('active');
    }
</script>